<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <span class="text-bold">PENGKAJIAN PRA-BEDAH</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($pengkajian->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form class="formlaporan_praoprasi">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diagnosa Pra - bedah</label>
                        <input type="text" class="form-control" id="diagnosaprabedah" name="diagnosaprabedah"
                            placeholder="Masukan diagnosa pra bedah ..." aria-describedby="emailHelp"
                            value="{{ $pengkajian->diagnosa_pra_bedah ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rencana Tindakan Operasi</label>
                        <input type="text" class="form-control" id="rencanatindakanoperasi"
                            name="rencanatindakanoperasi" placeholder="Masukan rencana tindakan operasi ..."
                            aria-describedby="emailHelp" value="{{ $pengkajian->diagnosa_pra_bedah ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">GCS</label>
                        @php
                            $gcs_split = isset($pengkajian->GCS) ? explode('|', $pengkajian->GCS) : [];
                            $gcs_e = $gcs_split[0] ?? '';
                            $gcs_v = $gcs_split[1] ?? '';
                            $gcs_m = $gcs_split[2] ?? '';
                        @endphp
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan GCS ..."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="GCS_E"
                                        id="GCS_E" value="{{ $gcs_e }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">E</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan GCS ..."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="GCS_V"
                                        value="{{ $gcs_v }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">V</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Masukan GCS ..."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2" name="GCS_M"
                                        value="{{ $gcs_m }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">M</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $TTV_split = isset($pengkajian->TTV) ? explode('|', $pengkajian->TTV) : [];
                            $TTV_1 = $TTV_split[0] ?? '';
                            $TTV_2 = $TTV_split[1] ?? '';
                            $TTV_3 = $TTV_split[2] ?? '';
                            $TTV_4 = $TTV_split[3] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Tekanan Darah</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tekanan darah pasien ..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    name="tekanandarah" value="{{ $TTV_1 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x / menit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Respirasi</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Respirasi pasien ..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    name="respirasi" value="{{ $TTV_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x / menit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Nadi</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Frekuensi nadi pasien ..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    name="frekuensinadi" value="{{ $TTV_3 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x / menit</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Suhu Tubuh</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="suhu tubuh pasien ..."
                                    aria-label="Recipient's username" aria-describedby="basic-addon2"
                                    name="suhutubuh" value="{{ $TTV_4 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">°C</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @php
                            $skala_nyeri_split = isset($pengkajian->skala_nyeri)
                                ? explode('|', $pengkajian->skala_nyeri)
                                : [];
                            $skala_nyeri_1 = $skala_nyeri_split[0] ?? '';
                            $skala_nyeri_2 = $skala_nyeri_split[1] ?? '';
                            $skala_nyeri_3 = $skala_nyeri_split[2] ?? '';
                        @endphp
                        <label for="exampleInputEmail1">
                            <h5 class="text-bold">Skala Nyeri</h5>
                        </label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NRS ( DEWASA )</label>
                                    <input type="email" class="form-control" id="NRS" name="NRS"
                                        placeholder="masukan skala nyeri pasien NRS ( DEWASA ) ..."
                                        aria-describedby="emailHelp" value="{{ $skala_nyeri_1 }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">FLACCS (anak) </label>
                                <input type="email" class="form-control" id="FLACCS" name="FLACCS"
                                    placeholder="Masukan skala nyeri pasien FLACCS ( ANAK ) ..."
                                    aria-describedby="emailHelp" value="{{ $skala_nyeri_2 }}">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">CPOT</label>
                                <input type="email" class="form-control" id="CPOT" name="CPOT"
                                    placeholder="Masukan skala nyeri CPOT ..." aria-describedby="emailHelp"
                                    value="{{ $skala_nyeri_3 }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status Lokalis</label>
                        <textarea type="text" class="form-control" id="statuslokalis" name="statuslokalis"
                            placeholder="Masukan status lokalis ..." aria-describedby="emailHelp">{{ $pengkajian->status_lokalis ?? '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Operasi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jadwaloperasi" id="jadwaloperasi"
                                value="1"
                                {{ !isset($pengkajian->jadwal_operasi) || $pengkajian->jadwal_operasi == '1' || empty($pengkajian->jadwal_operasi) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Terencana</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jadwaloperasi" id="jadwaloperasi"
                                value="2"
                                {{ isset($pengkajian->jadwal_operasi) && $pengkajian->jadwal_operasi == '2' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Darurat</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input type="date" class="form-control" id="tanggaloperasi" name="tanggaloperasi"
                                    aria-describedby="emailHelp" value="{{ $pengkajian->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi</label>
                                <input type="time" class="form-control" id="jamoperasi" name="jamoperasi"
                                    aria-describedby="emailHelp" value="{{ $pengkajian->jam_operasi ?? '00:00' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Pemeriksaan Radiologi</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pemerikssaanradiologi"
                                id="pemerikssaanradiologi" value="0"
                                {{ !isset($pengkajian->hasi_radiologi) || $pengkajian->hasi_radiologi == '0' || empty($pengkajian->hasi_radiologi) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pemerikssaanradiologi"
                                id="pemerikssaanradiologi" value="1"
                                {{ isset($pengkajian->hasi_radiologi) && $pengkajian->hasi_radiologi == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Ada</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Persiapan Darah</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="persiapandarah" id="persiapandarah"
                                value="0"
                                {{ !isset($pengkajian->persiapan_darah) || $pengkajian->persiapan_darah == '0' || empty($pengkajian->persiapan_darah) ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="persiapandarah" id="persiapandarah"
                                value="1"
                                {{ isset($pengkajian->persiapan_darah) && $pengkajian->persiapan_darah == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="inlineRadio2">Ada</label>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $WB_split = isset($pengkajian->WB) ? explode('|', $pengkajian->WB) : [];
                            $WB_1 = $WB_split[0] ?? '';
                            $WB_2 = $WB_split[1] ?? '';
                            $WB_3 = $WB_split[2] ?? '';
                            $WB_4 = $WB_split[3] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="WB"
                                                name="WB" value="1"
                                                @if ($WB_1 == 1) checked @endif>
                                            <label class="form-check-label" for="inlineCheckbox1">WB</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="WB_bag"
                                    value="{{ $WB_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Siap</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="WB_SIAP"
                                    value="{{ $WB_3 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Stand By</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="WB_STANDBY"
                                    value="{{ $WB_4 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $PRC_split = isset($pengkajian->PRC) ? explode('|', $pengkajian->PRC) : [];
                            $PRC_1 = $PRC_split[0] ?? '';
                            $PRC_2 = $PRC_split[1] ?? '';
                            $PRC_3 = $PRC_split[2] ?? '';
                            $PRC_4 = $PRC_split[3] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="PRC"
                                                name="PRC" value="1"
                                                @if ($PRC_1 == 1) checked @endif>
                                            <label class="form-check-label" for="inlineCheckbox1">PRC</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="PRC_BAG"
                                    value="{{ $PRC_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Siap</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="PRC_SIAP"
                                    value="{{ $PRC_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Stand By</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="PRC_STANDBY"
                                    value="{{ $PRC_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $TC_split = isset($pengkajian->TC) ? explode('|', $pengkajian->TC) : [];
                            $TC_1 = $TC_split[0] ?? '';
                            $TC_2 = $TC_split[1] ?? '';
                            $TC_3 = $TC_split[2] ?? '';
                            $TC_4 = $TC_split[3] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="TC"
                                                name="TC" value="1"
                                                @if ($TC_1 == 1) checked @endif>
                                            <label class="form-check-label" for="inlineCheckbox1">TC</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="TC_BAG"
                                    value="{{ $TC_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Siap</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="TC_SIAP"
                                    value="{{ $TC_3 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Stand By</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="TC_STANDBY"
                                    value="{{ $TC_4 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $FFP_split = isset($pengkajian->FFP) ? explode('|', $pengkajian->FFP) : [];
                            $FFP_1 = $FFP_split[0] ?? '';
                            $FFP_2 = $FFP_split[1] ?? '';
                            $FFP_3 = $FFP_split[2] ?? '';
                            $FFP_4 = $FFP_split[3] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="FFP"
                                                name="FFP" value="1"
                                                @if ($FFP_1 == 1) checked @endif>
                                            <label class="form-check-label" for="inlineCheckbox1">FFP</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="FFP_BAG"
                                    value="{{ $FFP_2 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Siap</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="FFP_SIAP"
                                    value="{{ $FFP_3 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label" for="inlineCheckbox1">Stand By</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="FFP_STANDBY"
                                    value="{{ $FFP_4 }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Bag</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $Lainnya_split = isset($pengkajian->Lainnya) ? explode('|', $pengkajian->Lainnya) : [];
                            $Lainnya_1 = $Lainnya_split[0] ?? '';
                            $Lainnya_2 = $Lainnya_split[1] ?? '';
                        @endphp
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="persiapandarah_lain"
                                                name="persiapandarah_lain" value="1"
                                                @if ($Lainnya_1 == 1) checked @endif>
                                            <label class="form-check-label" for="inlineCheckbox1">Lain Lain</label>
                                        </div>
                                    </span>
                                </div>
                                <input type="text" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" name="keterangan_persiapandarah_lain"
                                    value="{{ $Lainnya_2 }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Persiapan Implant</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="persiapanimpan"
                                        id="persiapanimpan" value="0"
                                        {{ !isset($pengkajian->persiapan_implant) || $pengkajian->persiapan_implant == '0' || empty($pengkajian->persiapan_implant) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="persiapanimpan"
                                        id="persiapanimpan" value="1"
                                        {{ isset($pengkajian->persiapan_implant) && $pengkajian->persiapan_implant == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Ada</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Merk</label>
                                <input type="email" class="form-control" id="merkimplan" name="merkimplan"
                                    aria-describedby="emailHelp" placeholder="Masukan merk ..."
                                    value="{{ $pengkajian->merk ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nama</label><br>
                            <input type="text" class="form-control" id="nama_1" name="nama_1"
                                aria-describedby="emailHelp" placeholder="Masukan nama ..."
                                value="{{ $pengkajian->nama_1 ?? '' }}">
                            <input type="text" class="form-control mt-2" id="nama_2" name="nama_2"
                                aria-describedby="emailHelp" placeholder="Masukan nama ..."
                                value="{{ $pengkajian->nama_2 ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nomor</label><br>
                            <input type="text" class="form-control" id="nomor_1" name="nomor_1"
                                aria-describedby="emailHelp" placeholder="Masukan nomor ..."
                                value="{{ $pengkajian->nomor_1 ?? '' }}">
                            <input type="text" class="form-control mt-2" id="nomor_2" name="nomor_2"
                                aria-describedby="emailHelp" placeholder="Masukan nomor ..."
                                value="{{ $pengkajian->nomor_2 ?? '' }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button {{ isset($pengkajian->pic) && $pengkajian->pic != Auth::id() ? 'disabled' : '' }}
                    class="btn btn-success" onclick="save_laporan_pra_op()"><i class="bi bi-bookmarks"></i>
                    Simpan Laporan</button>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <span class="text-bold">LAPORAN OPERASI</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($laporan_op->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="formlaporanoperasi">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ruang Operasi</label>
                                <input value="{{ $laporan_op->ruangoperasi ?? '' }}" type="text"
                                    class="form-control" id="ruangoperasi" name="ruangoperasi"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kamar</label>
                                <input value="{{ $laporan_op->kamaroperasi ?? '' }}" type="text"
                                    class="form-control" id="kamaroperasi" name="kamaroperasi"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cito Terencana</label>
                                <input value="{{ $laporan_op->citoterencana ?? '' }}" type="text"
                                    class="form-control" id="citoterencana" name="citoterencana"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input value="{{ $laporan_op->tanggaloperasi ?? $date }}" type="date"
                                    class="form-control" id="tanggaloperasi" name="tanggaloperasi"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi</label>
                                <input value="{{ $laporan_op->jamoperasi ?? '00:00' }}" type="time"
                                    class="form-control" id="jamoperasi" name="jamoperasi"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pembedah</label>
                                <textarea type="text" class="form-control" id="pembedah" name="pembedah" aria-describedby="emailHelp">{{ $laporan_op->pembedah ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ahli Anestesi</label>
                                <textarea type="text" class="form-control" id="ahlianestesi" name="ahlianestesi" aria-describedby="emailHelp">{{ $laporan_op->ahlianestesi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asisten I</label>
                                <textarea type="text" class="form-control" id="asisten1" name="asisten1" aria-describedby="emailHelp">{{ $laporan_op->asisten1 ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Asisten II</label>
                                <textarea type="text" class="form-control" id="asisten2" name="asisten2" aria-describedby="emailHelp">{{ $laporan_op->asisten2 ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Perawat Instrumen</label>
                                <textarea type="text" class="form-control" id="perawatinstrumen" name="perawatinstrumen"
                                    aria-describedby="emailHelp">{{ $laporan_op->perawatinstrumen ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Anestesi</label>
                                <textarea type="text" class="form-control" id="jenisanestesi" name="jenisanestesi" aria-describedby="emailHelp">{{ $laporan_op->jenisanestesi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Prabedah</label>
                                <textarea type="text" class="form-control" id="diagnosaprabedah" name="diagnosaprabedah"
                                    aria-describedby="emailHelp">{{ $laporan_op->diagnosaprabedah ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Indikasi Operasi</label>
                                <textarea type="text" class="form-control" id="indikasioperasi" name="indikasioperasi"
                                    aria-describedby="emailHelp">{{ $laporan_op->indikasioperasi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Pasca Bedah</label>
                                <textarea type="text" class="form-control" id="diagnosapascabedah" name="diagnosapascabedah"
                                    aria-describedby="emailHelp">{{ $laporan_op->diagnosapascabedah ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Operasi</label>
                                <textarea type="text" class="form-control" id="jenisoperasi" name="jenisoperasi" aria-describedby="emailHelp">{{ $laporan_op->jenisoperasi ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Desinfeksi Kulit dengan</label>
                                <textarea type="text" class="form-control" id="desinfeksikulitdengan" name="desinfeksikulitdengan"
                                    aria-describedby="emailHelp">{{ $laporan_op->desinfeksikulitdengan ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jaringan yang dieksisi</label>
                                <textarea type="text" class="form-control" id="jaringanyangdieksisi" name="jaringanyangdieksisi"
                                    aria-describedby="emailHelp">{{ $laporan_op->jaringanyangdieksisi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dikirm Ke bagian patologi anatomi :</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kirimkepatologi"
                                        id="kirimkepatologi" value="1"
                                        {{ isset($laporan_op->kirimkepatologi) && $laporan_op->kirimkepatologi == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="kirimkepatologi"
                                        id="kirimkepatologi" value="0"
                                        {{ !isset($laporan_op->kirimkepatologi) || $laporan_op->kirimkepatologi == '0' || empty($laporan_op->kirimkepatologi) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" id="jammulaioperasi"
                                    name="jammulaioperasi" aria-describedby="emailHelp"
                                    value="{{ $laporan_op->jammulaioperasi ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                                <input value="{{ $laporan_op->jamoperasiselesai ?? '00:00' }}" type="time"
                                    class="form-control" id="jamoperasiselesai" name="jamoperasiselesai"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Lama Operasi Berlangsung</label>
                                <input value="{{ $laporan_op->lamaoperasiberlangsung ?? '' }}" type="text"
                                    class="form-control" id="lamaoperasiberlangsung" name="lamaoperasiberlangsung"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis Bahan yang dikirimkan ke laboratorium ...</label>
                                <textarea type="text" class="form-control" id="jenisbahanyangdikirim" name="jenisbahanyangdikirim"
                                    aria-describedby="emailHelp">{{ $laporan_op->jenisbahanyangdikirim ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Untuk Pemerikssaan ...</label>
                                <textarea type="text" class="form-control" id="untukpemeriksaan" name="untukpemeriksaan"
                                    aria-describedby="emailHelp">{{ $laporan_op->untukpemeriksaan ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Macam sayatan ...</label>
                                <textarea type="text" class="form-control" id="macamsayatan" name="macamsayatan" aria-describedby="emailHelp">{{ $laporan_op->macamsayatan ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Posisi Penderita ...</label>
                                <textarea type="text" class="form-control" id="posisipenderita" name="posisipenderita"
                                    aria-describedby="emailHelp">{{ $laporan_op->posisipenderita ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="mb-2">Teknik Operasi dan temuan intra -
                                operasi</label>
                            @if (auth()->user()->unit == '1014')
                                <label for="exampleInputEmail1">1. Pasien tidur terlentang di meja operasi</label>
                                <label for="exampleInputEmail1">2. Dilakukan tindakan aseptik dan antiseptik dengan
                                    betadine
                                </label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pertanyaan2"
                                        id="pertanyaan2" value="Mata Kanan"
                                        {{ isset($laporan_op->pertanyaan2) && $laporan_op->pertanyaan2 == 'Mata Kanan' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">Mata Kanan</label>
                                </div>
                                <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                                    <input class="form-check-input" type="radio" name="pertanyaan2"
                                        id="pertanyaan2" value="Mata Kiri"
                                        {{ !isset($laporan_op->pertanyaan2) || $laporan_op->pertanyaan2 == 'Mata Kiri' || empty($laporan_op->pertanyaan2) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Mata Kiri</label>
                                </div><br>
                                <label for="exampleInputEmail1">3. Pasang Doek bolong </label><br>
                                <label for="exampleInputEmail1">4. Anestesi dengan lidokain topikal</label><br>
                                <label for="exampleInputEmail1">5. Pasang Klem </label><br>
                                <label for="exampleInputEmail1">6. Lakukan insisi dengan pisau </label><br>
                                <label for="exampleInputEmail1">7. Bersihkan hordeolum / kalazion dengan
                                    kuret</label><br>
                                <label for="exampleInputEmail1">8. Lepaskan klem </label><br>
                                <label for="exampleInputEmail1">9. Berikan Salep Antibiotik </label><br>
                                <label for="exampleInputEmail1">10. Operasi Selesai </label><br>
                            @else
                                <label for="exampleInputEmail1" class="mb-2">Teknik Operasi dan temuan intra -
                                    operasi</label>
                                <textarea cols="30" rows="10" class="form-control" placeholder="Silahkan isi disini ..."
                                    name="teknikoperasi" id="teknikoperasi">{{ $laporan_op->teknikoperasi ?? '' }}</textarea>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penggunaan BHP Khusus ...</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="penggunaanBHP"
                                        id="penggunaanBHP" value="0"
                                        {{ isset($laporan_op->penggunaanBHP) && $laporan_op->penggunaanBHP == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">TIDAK</label>
                                </div>
                                <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                                    <input class="form-check-input" type="radio" name="penggunaanBHP"
                                        id="penggunaanBHP" value="1"
                                        {{ !isset($laporan_op->penggunaanBHP) || $laporan_op->penggunaanBHP == '1' || empty($laporan_op->penggunaanBHP) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">YA</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jenis dan jumlah BHP ...</label>
                                <textarea type="text" class="form-control" id="jenisjumlahBHP" name="jenisjumlahBHP"
                                    aria-describedby="emailHelp">{{ $laporan_op->jenisjumlahBHP ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Komplikasi Intra-operasi...</label><br>
                                <div class="form-check form-check-inline">
                                    <input
                                        {{ isset($laporan_op->komplikasiintraoprasi) && $laporan_op->komplikasiintraoprasi == '0' ? 'checked' : '' }}
                                        class="form-check-input" type="radio" name="komplikasiintraoprasi"
                                        id="komplikasiintraoprasi" value="0">
                                    <label class="form-check-label" for="inlineRadio1">TIDAK</label>
                                </div>
                                <div class="form-check form-check-inline mb-2 mr-1 ml-1">
                                    <input
                                        {{ !isset($laporan_op->komplikasiintraoprasi) || $laporan_op->komplikasiintraoprasi == '1' || empty($laporan_op->komplikasiintraoprasi) ? 'checked' : '' }}
                                        class="form-check-input" type="radio" name="komplikasiintraoprasi"
                                        id="komplikasiintraoprasi" value="1">
                                    <label class="form-check-label" for="inlineRadio2">YA</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Penjabaran Komplikasi Intra-Operasi ...</label>
                                <textarea type="text" class="form-control" id="penjabarankomplikasi" name="penjabarankomplikasi"
                                    aria-describedby="emailHelp">{{ $laporan_op->penjabarankomplikasi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Perdarahan ...</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="perdarahan" id="perdarahan"
                                        value="{{ $laporan_op->perdarahan ?? '' }}">
                                    <span class="input-group-text" id="basic-addon2">cc</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">Instruksi Pasca Bedah</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">1. Kontrol nadi /
                                        tensi /
                                        pernafasan /
                                        suhu ...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="kontrolnaditensi"
                                        id="kontrolnaditensi">{{ $laporan_op->kontrolnaditensi ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">5. Obat Obatan
                                        ...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="obatobatan" id="obatobatan">{{ $laporan_op->obatobatan ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">2. Puasa ...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="puasa" id="puasa">{{ $laporan_op->puasa ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">6. Ganti
                                        Balut...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="gantibalut" id="gantibalut">{{ $laporan_op->gantibalut ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">3. Drain...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="drain" id="drain">{{ $laporan_op->drain ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">7. Lain
                                        Lain...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="lainlain" id="lainlain">{{ $laporan_op->lainlain ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label">4. Infus...</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="infus" id="infus">{{ $laporan_op->infus ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @if (count($cek) > 0)
                    @if ($cek[0]->pic != auth()->user()->id)
                        <h5 class="text-danger mb-2">Laporan operasi sudah diisi oleh {{ $username }}...</h5>
                    @endif
                @endif
                <button class="btn btn-success" onclick="sve()"
                    @if (count($cek) > 0) @if ($cek[0]->pic != auth()->user()->id) disabled @endif @endif><i class="bi bi-download"></i> Simpan</button>
            </div>
        </div>
    </div>
    <div @if (auth()->user()->unit != '1014') hidden @endif class="card">
        <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
                    aria-controls="collapseThree">
                    <span class="text-bold">LAPORAN OPERASI KATARAK</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($katarak->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="formlaporan_operasikatarak">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tanggaloperasi">Tanggal Operasi</label>
                                <input type="date" class="form-control" id="tanggaloperasi"
                                    name="tanggal_operasi" value="{{ $katarak->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jam_mulai">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai"
                                    value="{{ $katarak->jam_mulai ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="jam_selesai">Jam Operasi selesai</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai"
                                    value="{{ $katarak->jam_selesai ?? '00:00' }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ahli_bedah">Nama ahli bedah</label>
                                    <input type="text" class="form-control" id="ahli_bedah" name="ahli_bedah"
                                        value="{{ $katarak->ahli_bedah ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ahli_anestesi">Nama ahli anestesi</label>
                                    <input type="text" class="form-control" id="ahli_anestesi"
                                        name="ahli_anestesi" value="{{ $katarak->ahli_anestesi ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_asisten">Nama asisten</label>
                                    <input type="text" class="form-control" id="nama_asisten"
                                        name="nama_asisten" value="{{ $katarak->nama_asisten ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_perawat">Nama Perawat</label>
                                    <input type="text" class="form-control" id="nama_perawat"
                                        name="nama_perawat" value="{{ $katarak->nama_perawat ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                @php
                                    $anestesi_spli = isset($katarak->anestesi) ? explode('|', $katarak->anestesi) : [];
                                    $anestesi_1 = $anestesi_spli[0] ?? '';
                                    $anestesi_2 = $anestesi_spli[1] ?? '';
                                    $anestesi_3 = $anestesi_spli[2] ?? '';
                                    $anestesi_4 = $anestesi_spli[3] ?? '';
                                    $anestesi_5 = $anestesi_spli[4] ?? '';
                                    $anestesi_6 = $anestesi_spli[5] ?? '';
                                @endphp
                                <label>Jenis Anestesi</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_nu"
                                        name="anestesi_nu" value="NU"
                                        {{ $anestesi_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anestesi_nu">NU</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_retrobular"
                                        name="anestesi_retrobular" value="RETROBULAR"
                                        {{ $anestesi_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anestesi_retrobular">RETROBULAR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_peribular"
                                        name="anestesi_peribular" value="Peribular"
                                        {{ $anestesi_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anestesi_peribular">Peribular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_topikal"
                                        name="anestesi_topikal" value="Topikal"
                                        {{ $anestesi_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anestesi_topikal">Topikal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_subtenon"
                                        name="anestesi_subtenon" value="Subtenon"
                                        {{ $anestesi_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="anestesi_subtenon">Subtenon</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="anestesi_subkonjungtiva"
                                        name="anestesi_subkonjungtiva" value="Subkonjungtiva"
                                        {{ $anestesi_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="anestesi_subkonjungtiva">Subkonjungtiva</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="visus_pre_ops">Visus Pre - Operasi</label>
                                <input type="text" class="form-control" id="visus_pre_ops"
                                    name="visus_pre_ops" value="{{ $katarak->visus_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="diagnosa_pre_ops">Diagnosa sebelum Operasi</label>
                                <input type="text" class="form-control" id="diagnosa_pre_ops"
                                    name="diagnosa_pre_ops" value="{{ $katarak->diagnosa_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="diagnosa_post_ops">Diagnosa paska Operasi</label>
                                <input type="text" class="form-control" id="diagnosa_post_ops"
                                    name="diagnosa_post_ops" value="{{ $katarak->diagnosa_post_ops ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="macam_operasi">Nama / Macam Operasi</label>
                                <textarea class="form-control" id="macam_operasi" name="macam_operasi" rows="2">{{ $katarak->macam_operasi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>Komplikasi atau penyulit</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi"
                                    id="komplikasi_tidak" value="Tidak Ada"
                                    {{ !isset($katarak->komplikasi) || $katarak->komplikasi == 'Tidak Ada' || empty($katarak->komplikasi) ? 'checked' : '' }}>
                                <label class="form-check-label" for="komplikasi_tidak">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi"
                                    id="komplikasi_ada" value="Ada"
                                    {{ isset($katarak->komplikasi) && $katarak->komplikasi == 'Ada' ? 'checked' : '' }}>
                                <label class="form-check-label" for="komplikasi_ada">Ada</label>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm mt-3">
                        <tr>
                            <td colspan="2"><strong>Laporan Operasi</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2">Tindakan Aseptik dan Antiseptik</td>
                        </tr>
                        <tr>
                            @php
                                $insisi_split = isset($katarak->insisi) ? explode('|', $katarak->insisi) : [];
                                $insisi_1 = $insisi_split[0] ?? '';
                                $insisi_2 = $insisi_split[1] ?? '';
                                $insisi_3 = $insisi_split[2] ?? '';
                                $insisi_4 = $insisi_split[3] ?? '';
                                $insisi_5 = $insisi_split[4] ?? '';
                            @endphp
                            <td style="width:25%">Insisi main port</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="insisi_sklera"
                                        name="insisi_sklera" value="Sklera"
                                        {{ $insisi_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="insisi_sklera">Sklera</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="insisi_kornea"
                                        name="insisi_kornea" value="Kornea"
                                        {{ $insisi_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="insisi_kornea">Kornea</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Lokasi & Ukuran</td>
                            <td>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="lokasi_superior"
                                        name="lokasi_superior" value="Superior"
                                        {{ $insisi_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lokasi_superior">Superior</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="lokasi_temporal"
                                        name="lokasi_temporal" value="Temporal"
                                        {{ $insisi_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="lokasi_temporal">Temporal</label>
                                </div>
                                <div class="input-group mb-2" style="max-width: 250px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Ukuran</span>
                                    </div>
                                    <input type="text" class="form-control" id="ukuran_insisi"
                                        name="ukuran_insisi" value="{{ $insisi_5 }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">mm</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Injeksi tryphan blue kedalam bilik mata depan</td>
                        </tr>
                        <tr>
                            <td colspan="2">Irigasi bilik mata depan dan injeksi viscoelastic</td>
                        </tr>
                        <tr>
                            <td>Dilakukan kapsulotomi anterior :</td>
                            <td>
                                <label class="mb-0"><strong>Hidrodiseksi</strong></label><br>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="hidrodiseksi"
                                        id="hidrodiseksi_ya" value="Ya"
                                        {{ isset($katarak->hidrodiseksi) && $katarak->hidrodiseksi == 'Ya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrodiseksi_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="hidrodiseksi"
                                        id="hidrodiseksi_tidak" value="Tidak"
                                        {{ !isset($katarak->hidrodiseksi) || $katarak->hidrodiseksi == 'Tidak' || empty($katarak->hidrodiseksi) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrodiseksi_tidak">Tidak</label>
                                </div><br>

                                <label class="mb-0"><strong>Hidrodelineasi</strong></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hidrodelineasi"
                                        id="hidrodelineasi_ya" value="Ya"
                                        {{ isset($katarak->hidrodelineasi) && $katarak->hidrodelineasi == 'Ya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrodelineasi_ya">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="hidrodelineasi"
                                        id="hidrodelineasi_tidak" value="Tidak"
                                        {{ !isset($katarak->hidrodelineasi) || $katarak->hidrodelineasi == 'Tidak' || empty($katarak->hidrodelineasi) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrodelineasi_tidak">Tidak</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Teknik ekstraksi nukleus :</td>
                            <td>
                                @php
                                    $nukleus_split = isset($katarak->teknik_ekstraksi_nukleus)
                                        ? explode('|', $katarak->teknik_ekstraksi_nukleus)
                                        : [];
                                    $nukleus_1 = $nukleus_split[0] ?? '';
                                    $nukleus_2 = $nukleus_split[1] ?? '';
                                    $nukleus_3 = $nukleus_split[2] ?? '';
                                    $nukleus_4 = $nukleus_split[3] ?? '';
                                    $nukleus_5 = $nukleus_split[4] ?? '';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="teknik_sics"
                                        name="teknik_sics" value="SICS"
                                        {{ $nukleus_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknik_sics">SICS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="teknik_phaco"
                                        name="teknik_phaco" value="Phaco"
                                        {{ $nukleus_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknik_phaco">Phaco</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="teknik_aspirasi"
                                        name="teknik_aspirasi" value="Aspirasi Irigasi"
                                        {{ $nukleus_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknik_aspirasi">Aspirasi Irigasi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="teknik_icce"
                                        name="teknik_icce" value="ICCE"
                                        {{ $nukleus_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknik_icce">ICCE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="teknik_ecce"
                                        name="teknik_ecce" value="ECCE"
                                        {{ $nukleus_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="teknik_ecce">ECCE</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Dilakukan aspirasi irigasi sisa viscoelastic</td>
                        </tr>
                        <tr>
                            @php
                                $lensa_split = isset($katarak->pemasangan_lensa_intraocular)
                                    ? explode('|', $katarak->pemasangan_lensa_intraocular)
                                    : [];
                                $lensa_1 = $lensa_split[0] ?? '';
                                $lensa_2 = $lensa_split[1] ?? '';
                                $lensa_3 = $lensa_split[2] ?? '';
                                $lensa_4 = $lensa_split[3] ?? '';
                                $lensa_5 = $lensa_split[4] ?? '';
                                $lensa_6 = $lensa_split[5] ?? '';
                            @endphp
                            <td>Pemasangan lensa intraocular :</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_bmd"
                                        name="iol_bmd" value="Bilik Mata Depan"
                                        {{ $lensa_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_bmd">Bilik Mata Depan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_bmb"
                                        name="iol_bmb" value="Bilik Mata Belakang"
                                        {{ $lensa_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_bmb">Bilik Mata Belakang</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_sulkus"
                                        name="iol_sulkus" value="Sulkus siliaris"
                                        {{ $lensa_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_sulkus">Sulkus siliaris</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_fiksasi_sklera"
                                        name="iol_fiksasi_sklera" value="Fiksasi Sklera"
                                        {{ $lensa_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_fiksasi_sklera">Fiksasi Sklera</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_fiksasi_iris"
                                        name="iol_fiksasi_iris" value="Fiksasi Iris"
                                        {{ $lensa_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_fiksasi_iris">Fiksasi Iris</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="iol_afakia"
                                        name="iol_afakia" value="Afakia" {{ $lensa_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="iol_afakia">Tidak dipasang (Afakia)</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            @php
                                $hidrasi_split = isset($katarak->hidrasi) ? explode('|', $katarak->hidrasi) : [];
                                $hidrasi_1 = $hidrasi_split[0] ?? '';
                                $hidrasi_2 = $hidrasi_split[1] ?? '';
                            @endphp
                            <td>Dilakukan hidrasi :</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="hidrasi_side_port"
                                        name="hidrasi_side_port" value="Side Port"
                                        {{ $hidrasi_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrasi_side_port">Side Port</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="hidrasi_main_port"
                                        name="hidrasi_main_port" value="Main Port"
                                        {{ $hidrasi_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="hidrasi_main_port">Main Port</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            @php
                                $jahitan_split = isset($katarak->jahitan) ? explode('|', $katarak->jahitan) : [];
                                $jahitan_1 = $jahitan_split[0] ?? '';
                                $jahitan_2 = $jahitan_split[1] ?? '';
                            @endphp
                            <td>Jahitan :</td>
                            <td>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="jahitan" id="jahitan"
                                        value="Tidak"
                                        {{ !isset($jahitan_1) || $jahitan_1 == 'Tidak' || empty($jahitan_1) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jahitan_tidak">Tidak</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="radio" name="jahitan" id="jahitan"
                                        value="Ya"
                                        {{ isset($jahitan_1) && $jahitan_1 == 'Ya' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="jahitan_ya">Ya</label>
                                </div>
                                <input type="text" class="form-control" id="jumlah_jahitan"
                                    name="jumlah_jahitan" placeholder="Jumlah jahitan ..."
                                    value="{{ $jahitan_2 }}">
                            </td>
                        </tr>
                        <tr>
                            @php
                                $ab_split = isset($katarak->injeksi_antibiotik)
                                    ? explode('|', $katarak->injeksi_antibiotik)
                                    : [];
                                $ab_1 = $ab_split[0] ?? '';
                                $ab_2 = $ab_split[1] ?? '';
                            @endphp
                            <td>Injeksi antibiotik :</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inj_steroid"
                                        name="inj_steroid" value="Steroid Subkonjungtiva"
                                        {{ $ab_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inj_steroid">Steroid Subkonjungtiva</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="inj_intrakameral"
                                        name="inj_intrakameral" value="Antibiotik intrakameral"
                                        {{ $ab_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inj_intrakameral">Antibiotik
                                        intrakameral</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            @php
                                $tindakan_split = isset($katarak->tindakan_tambahan)
                                    ? explode('|', $katarak->tindakan_tambahan)
                                    : [];
                                $tt_1 = $tindakan_split[0] ?? '';
                                $tt_2 = $tindakan_split[1] ?? '';
                                $tt_3 = $tindakan_split[2] ?? '';
                                $tt_4 = $tindakan_split[3] ?? '';
                                $tt_5 = $tindakan_split[4] ?? '';
                            @endphp
                            <td>Tindakan tambahan :</td>
                            <td>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="tambahan_vitrektomi"
                                        name="tambahan_vitrektomi" value="Vitrektomi"
                                        {{ $tt_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tambahan_vitrektomi">Vitrektomi</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="tambahan_sinekiolisis"
                                        name="tambahan_sinekiolisis" value="Sinekiolisis"
                                        {{ $tt_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tambahan_sinekiolisis">Sinekiolisis</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="tambahan_kapsulotomi"
                                        name="tambahan_kapsulotomi" value="Kapsulotomi posterior"
                                        {{ $tt_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tambahan_kapsulotomi">Kapsulotomi
                                        posterior</label>
                                </div>
                                <div class="form-check form-check-inline mb-2">
                                    <input class="form-check-input" type="checkbox" id="tambahan_jahitan_iris"
                                        name="tambahan_jahitan_iris" value="Jahitan Iris"
                                        {{ $tt_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tambahan_jahitan_iris">Jahitan Iris</label>
                                </div>
                                <input type="text" class="form-control" id="jumlah_jahitan_iris"
                                    name="jumlah_jahitan_iris" placeholder="Jumlah jahitan iris ..."
                                    value="{{ $tt_5 }}">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="save_laporan_op_katarak()"><i
                        class="bi bi-bookmarks"></i>
                    Simpan Laporan</button>
            </div>
        </div>
    </div>
    <div @if (auth()->user()->unit != '1014') hidden @endif class="card">
        <div class="card-header" id="headingFour">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
                    aria-controls="collapseFour">
                    <span class="text-bold">LAPORAN OPERASI KATARAK & GLAUKOMA</span>
                    <span class="badge badge-info p-2" style="font-size: 11px;"><i class="fas fa-edit mr-1"></i>
                        Klik untuk Isi Form</span>
                </button>
            </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($glaukoma->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="form_laporanoperasikatarakglaukoma">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input type="date" class="form-control" id="tanggaloperasi"
                                    name="tanggaloperasi" aria-describedby="emailHelp"
                                    value="{{ $glaukoma->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" id="jammulaioperasi"
                                    name="jammulaioperasi" aria-describedby="emailHelp"
                                    value="{{ $glaukoma->jam_mulai ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                                <input type="time" class="form-control" id="jamselesai" name="jamselesai"
                                    aria-describedby="emailHelp" value="{{ $katarak->jam_selesai ?? '00:00' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli bedah</label>
                                    <input type="email" class="form-control" id="namaahlibedan"
                                        name="namaahlibedah" aria-describedby="emailHelp"
                                        value="{{ $katarak->ahli_bedah ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli anestesi</label>
                                    <input type="email" class="form-control" name="namaahlianestesi"
                                        aria-describedby="emailHelp" value="{{ $katarak->ahli_anestesi ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama asisten</label>
                                    <input type="email" class="form-control" name="namaasisten"
                                        aria-describedby="emailHelp" value="{{ $katarak->nama_asisten ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Perawat</label>
                                    <input type="email" class="form-control" name="namaperawat"
                                        aria-describedby="emailHelp" value="{{ $katarak->nama_perawat ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                @php
                                    $anestesi_split = isset($glaukoma->anestesi)
                                        ? explode('|', $glaukoma->anestesi)
                                        : [];
                                    $an_1 = $anestesi_split[0] ?? '';
                                    $an_2 = $anestesi_split[1] ?? '';
                                    $an_3 = $anestesi_split[2] ?? '';
                                    $an_4 = $anestesi_split[3] ?? '';
                                    $an_5 = $anestesi_split[4] ?? '';
                                    $an_6 = $anestesi_split[5] ?? '';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="NU"
                                        value="1" {{ $an_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">NU</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="RETROBULAR"
                                        value="1" {{ $an_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">RETROBULAR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="peribular"
                                        value="1" {{ $an_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Peribular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="topikal"
                                        value="1" {{ $an_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Topikal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="subteneon"
                                        value="1" {{ $an_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Subtenon</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="subkonjungtiva"
                                        value="1" {{ $an_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Subkonjungtiva</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Visus Pre - Operasi</label>
                                <input type="email" class="form-control" name="visuspreop"
                                    aria-describedby="emailHelp" value="{{ $glaukoma->visus_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa sebelum Operasi</label>
                                <input type="email" class="form-control" name="diagnosasebelumoperasi"
                                    aria-describedby="emailHelp" value="{{ $glaukoma->diagnosa_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa paska Operasi</label>
                                <input type="email" class="form-control" name="diagnosapaskaoperasi"
                                    aria-describedby="emailHelp" value="{{ $glaukoma->diagnosa_post_ops ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama / Macam Operasi</label>
                                <textarea type="email" class="form-control" name="macamoperasi" aria-describedby="emailHelp">{{ $glaukoma->macam_operasi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Komplikasi atau penyulit </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi" id="komplikasi"
                                    value="0"
                                    {{ !isset($glaukoma->komplikasi) || $glaukoma->komplikasi == '0' || empty($glaukoma->komplikasi) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi" id="komplikasi"
                                    value="1"
                                    {{ isset($glaukoma->komplikasi) && $glaukoma->komplikasi == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <td colspan="2">Laporan Operasi</td>
                        </tr>
                        <tr>
                            <td style="width:10%">Anestesis</td>
                            <td>
                                @php
                                    $anestesis_split = isset($glaukoma->Anestesis)
                                        ? explode('|', $glaukoma->Anestesis)
                                        : [];
                                    $ans_1 = $anestesis_split[0] ?? '';
                                    $ans_2 = $anestesis_split[1] ?? '';
                                    $ans_3 = $anestesis_split[2] ?? '';
                                    $ans_4 = $anestesis_split[3] ?? '';
                                    $ans_5 = $anestesis_split[4] ?? '';
                                    $ans_6 = $anestesis_split[5] ?? '';
                                    $ans_7 = $anestesis_split[6] ?? '';
                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_retrobuller"
                                        value="1" {{ $ans_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Retrobuller</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesi_peribuller"
                                        value="1" {{ $ans_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Peribuller</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_topikal"
                                        value="1" {{ $ans_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Topikal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_subtenon"
                                        value="1" {{ $ans_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Subtenon</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_lodocain"
                                        value="1" {{ $ans_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lodocain 2%</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_marcain"
                                        value="1" {{ $ans_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Marcain 0,5 %</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="anestesis_lainnya"
                                        value="1" {{ $ans_7 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain-lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%">Akinese</td>
                            @php
                                $akinese_split = isset($glaukoma->Akinese) ? explode('|', $glaukoma->Akinese) : [];
                                $ak_1 = $akinese_split[0] ?? '';
                                $ak_2 = $akinese_split[1] ?? '';
                                $ak_3 = $akinese_split[2] ?? '';

                                $flap_split = isset($glaukoma->flapkonjungtiva)
                                    ? explode('|', $glaukoma->flapkonjungtiva)
                                    : [];
                                $fl_1 = $flap_split[0] ?? '';
                                $fl_2 = $flap_split[1] ?? '';

                                $lokasi_split = isset($glaukoma->lokasi) ? explode('|', $glaukoma->lokasi) : [];
                                $lok_1 = $lokasi_split[0] ?? '';
                                $lok_2 = $lokasi_split[1] ?? '';
                                $lok_3 = $lokasi_split[2] ?? '';
                                $lok_4 = $lokasi_split[3] ?? '';
                            @endphp
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="akinese_obrien"
                                        value="1" {{ $ak_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">O’brien</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="akinese_vanlint"
                                        value="1" {{ $ak_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Van Lint</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="akinese_lainnya"
                                        value="1" {{ $ak_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain-lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%">Flap konjungtiva</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="basis_formiks"
                                        value="1" {{ $fl_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Basis Formiks</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="basis_limbus"
                                        value="1" {{ $fl_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Basis Limbus</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:10%">Lokasi</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="superonasal"
                                        value="1" {{ $lok_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Superonasal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="superior"
                                        value="1" {{ $lok_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Superior</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Superotemporal"
                                        value="1" {{ $lok_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Superotemporal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="lokasi_lainnya"
                                        value="1" {{ $lok_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain - lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Flap Sklera</td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="flap_sklera" value="{{ $glaukoma->flapsklera ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">JENIS BEDAH</td>
                        </tr>
                        @php
                            $glaukoma_split = isset($glaukoma->glaukoma) ? explode('|', $glaukoma->glaukoma) : [];
                            $gl_1 = $glaukoma_split[0] ?? '';
                            $gl_2 = $glaukoma_split[1] ?? '';
                            $gl_3 = $glaukoma_split[2] ?? '';
                            $gl_4 = $glaukoma_split[3] ?? '';

                            $jenis_insisi_split = isset($glaukoma->jenis_insisi)
                                ? explode('|', $glaukoma->jenis_insisi)
                                : [];
                            $jn_1 = $jenis_insisi_split[0] ?? '';
                            $jn_2 = $jenis_insisi_split[1] ?? '';
                            $jn_3 = $jenis_insisi_split[2] ?? '';
                            $jn_4 = $jenis_insisi_split[3] ?? '';
                            $jn_5 = $jenis_insisi_split[4] ?? '';

                            $alat_split = isset($glaukoma->alat) ? explode('|', $glaukoma->alat) : [];
                            $alat_1 = $alat_split[0] ?? '';
                            $alat_2 = $alat_split[1] ?? '';
                            $alat_3 = $alat_split[2] ?? '';

                            $Capsulectomy_split = isset($glaukoma->Capsulectomy)
                                ? explode('|', $glaukoma->Capsulectomy)
                                : [];
                            $Capsulectomy_1 = $Capsulectomy_split[0] ?? '';
                            $Capsulectomy_2 = $Capsulectomy_split[1] ?? '';
                            $Capsulectomy_3 = $Capsulectomy_split[2] ?? '';

                            $ekstraksi_lensa_split = isset($glaukoma->ekstraksi_lensa)
                                ? explode('|', $glaukoma->ekstraksi_lensa)
                                : [];
                            $ekstraksi_1 = $ekstraksi_lensa_split[0] ?? '';
                            $ekstraksi_2 = $ekstraksi_lensa_split[1] ?? '';
                            $ekstraksi_3 = $ekstraksi_lensa_split[2] ?? '';
                            $ekstraksi_4 = $ekstraksi_lensa_split[3] ?? '';
                            $ekstraksi_5 = $ekstraksi_lensa_split[4] ?? '';

                            $tindakan_tambahan_split = isset($glaukoma->tindakan_tambahan)
                                ? explode('|', $glaukoma->tindakan_tambahan)
                                : [];
                            $tindakant_1 = $tindakan_tambahan_split[0] ?? '';
                            $tindakant_2 = $tindakan_tambahan_split[1] ?? '';
                            $tindakant_3 = $tindakan_tambahan_split[2] ?? '';
                            $tindakant_4 = $tindakan_tambahan_split[3] ?? '';

                            $cairan_irigasi_split = isset($glaukoma->cairan_irigasi)
                                ? explode('|', $glaukoma->cairan_irigasi)
                                : [];
                            $cairan_1 = $cairan_irigasi_split[0] ?? '';
                            $cairan_2 = $cairan_irigasi_split[1] ?? '';
                            $cairan_3 = $cairan_irigasi_split[2] ?? '';

                        @endphp
                        <tr>
                            <td>Glaukoma</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="goniotomi"
                                        value="1" {{ $gl_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Goniotomi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Trabekulektomi"
                                        value="1" {{ $gl_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Trabekulektomi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="TripleProsedur"
                                        value="1" {{ $gl_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Triple Prosedur</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="glaukomalainnya"
                                        value="1" {{ $gl_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain-lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Insisi</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Kornea"
                                        value="1" {{ $jn_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Kornea</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="insisi_Limbus"
                                        value="1" {{ $jn_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Limbus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="insisi_sklera"
                                        value="1" {{ $jn_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Sklera</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="insisi_skleratunnel"
                                        value="1" {{ $jn_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Skleratunnel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="insisi_sideport"
                                        value="1" {{ $jn_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Side Port</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alat</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Jarum"
                                        value="1" {{ $alat_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Jarum</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Crescent"
                                        value="1" {{ $alat_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Crescent</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Diamond"
                                        value="1" {{ $alat_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Diamond</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Capsulectomy Anterior</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="CanOponer"
                                        value="1" {{ $Capsulectomy_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Can Oponer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Envelope"
                                        value="1" {{ $Capsulectomy_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Envelope</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="CCC"
                                        value="1" {{ $Capsulectomy_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">CCC</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Ekstraksi Lensa</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="ICCE"
                                        value="1" {{ $ekstraksi_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">ICCE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="ECCE"
                                        value="1" {{ $ekstraksi_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">ECCE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="SICE"
                                        value="1" {{ $ekstraksi_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">SICE</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="PHACO"
                                        value="1" {{ $ekstraksi_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">PHACO</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="ekstraksi_Lain"
                                        value="1" {{ $ekstraksi_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain-lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tindakan Tambahan</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Shincter"
                                        value="1" {{ $tindakant_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Shincter otomy</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Sinechiolysisis"
                                        value="1" {{ $tindakant_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Sinechiolysisis</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Virektomi"
                                        value="1" {{ $tindakant_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Virektomi Anterior</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Jahitaniris"
                                        value="1" {{ $tindakant_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Jahitan Iris</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cairan Irigasi</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="RL"
                                        value="1" {{ $cairan_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">R.L</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="BSS"
                                        value="1" {{ $cairan_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">BSS</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="irigasi_lain"
                                        value="1" {{ $cairan_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain-lain</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            @php
                                $LIO_split = isset($glaukoma->LIO) ? explode('|', $glaukoma->LIO) : [];
                                $lio_1 = $LIO_split[0] ?? '';
                                $lio_2 = $LIO_split[1] ?? '';
                                $lio_3 = $LIO_split[2] ?? '';
                                $lio_4 = $LIO_split[3] ?? '';
                                $lio_5 = $LIO_split[4] ?? '';
                                $lio_6 = $LIO_split[5] ?? '';
                                $lio_7 = $LIO_split[6] ?? '';
                                $lio_8 = $LIO_split[7] ?? '';
                                $lio_9 = $LIO_split[8] ?? '';
                                $lio_10 = $LIO_split[9] ?? '';

                                $FIKSASILIO_split = isset($glaukoma->Fiksasi_LIO)
                                    ? explode('|', $glaukoma->Fiksasi_LIO)
                                    : [];
                                $flio_1 = $FIKSASILIO_split[0] ?? '';
                                $flio_2 = $FIKSASILIO_split[1] ?? '';

                                $visco_split = isset($glaukoma->Viscoelastik)
                                    ? explode('|', $glaukoma->Viscoelastik)
                                    : [];
                                $visco_1 = $visco_split[0] ?? '';
                                $visco_2 = $visco_split[1] ?? '';
                                $visco_3 = $visco_split[2] ?? '';
                                $visco_4 = $visco_split[3] ?? '';
                                $visco_5 = $visco_split[4] ?? '';

                                $benang_split = isset($glaukoma->Benang) ? explode('|', $glaukoma->Benang) : [];
                                $benang_1 = $benang_split[0] ?? '';
                                $benang_2 = $benang_split[1] ?? '';

                                $komplikasi2_split = isset($glaukoma->komplikasi_2)
                                    ? explode('|', $glaukoma->komplikasi_2)
                                    : [];
                                $komplikasi2_1 = $komplikasi2_split[0] ?? '';
                                $komplikasi2_2 = $komplikasi2_split[1] ?? '';
                                $komplikasi2_3 = $komplikasi2_split[2] ?? '';
                                $komplikasi2_4 = $komplikasi2_split[3] ?? '';
                                $komplikasi2_5 = $komplikasi2_split[4] ?? '';
                            @endphp
                            <td>L.I.O</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="BMB"
                                        value="1" {{ $lio_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">B.M.B</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="BMD"
                                        value="1" {{ $lio_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">B.M.D</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="diputar"
                                        value="1" {{ $lio_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Diputar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="tidakdiputar"
                                        value="1" {{ $lio_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Tidak Diputar</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="horisontal"
                                        value="1" {{ $lio_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Horisontal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="loop"
                                        value="1" {{ $lio_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">J Loop</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="cloop"
                                        value="1" {{ $lio_7 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">C Loop</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dilipat"
                                        value="1" {{ $lio_8 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Dilipat</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="sulvus"
                                        value="1" {{ $lio_9 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Sulvus Siliaris</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="dalamdiluarkantung"
                                        value="1" {{ $lio_10 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Dalam/Diluar Kantung
                                        Kapsul</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Fiksasi L.I.O</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Vertikal"
                                        value="1" {{ $flio_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Vertikal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="fiksasi_Horisontal"
                                        value="1" {{ $flio_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Horisontal</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Cairan Viscoelastik</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="survisc"
                                        value="1" {{ $visco_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Survisc</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Starvisc"
                                        value="1" {{ $visco_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Starvisc</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Rohtovisc"
                                        value="1" {{ $visco_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Rohtovisc</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Catgel"
                                        value="1" {{ $visco_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Catgel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="IMD"
                                        value="1" {{ $visco_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">IMD Gel</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Benang</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="benangVicryl"
                                        value="1" {{ $benang_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Vicryl 8-0</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="benangnylon"
                                        value="1" {{ $benang_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Nylon 10-0</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>TIO Pra Bedah</td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OD</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="OD_PRA_BEDAH"
                                        value="{{ $glaukoma->OD_PRA_BEDAH ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MmHg</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="OS_PRA_BEDAH"
                                        value="{{ $glaukoma->OS_PRA_BEDAH ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">MmHg</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Komplikasi</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="komplikasi_ada"
                                        value="1" {{ $komplikasi2_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="komplikasi_tidakada"
                                        value="1" {{ $komplikasi2_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Tidak Ada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Prolaps"
                                        value="1" {{ $komplikasi2_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Prolaps vitreus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Perdarahan"
                                        value="1" {{ $komplikasi2_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Perdarahan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="komplikasi_lain"
                                        value="1" {{ $komplikasi2_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Lain - lain</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="save_laporan_op_katarakglaukoma()"><i
                        class="bi bi-bookmarks"></i>Simpan Laporan</button>
            </div>
        </div>
    </div>
    <div @if (auth()->user()->unit != '1014') hidden @endif class="card">
        <div class="card-header" id="headingFive">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
                    aria-controls="collapseFive">
                    <span class="text-bold">LAPORAN OPERASI TRABECULEKTOMI</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($trabec->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="form_laporanoperasitrabeculektomi">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input type="date" class="form-control" name="tgloperasi"
                                    aria-describedby="emailHelp" value="{{ $trabec->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" name="jamoperasimulai"
                                    aria-describedby="emailHelp" value="{{ $trabec->jam_mulai ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                                <input type="time" class="form-control" name="jamoperasiselesai"
                                    aria-describedby="emailHelp" value="{{ $trabec->jam_selesai ?? '00:00' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli bedah</label>
                                    <input type="email" class="form-control" name="ahlibedah"
                                        aria-describedby="emailHelp" value="{{ $trabec->ahli_bedah ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli anestesi</label>
                                    <input type="email" class="form-control" name="ahlianestesi"
                                        aria-describedby="emailHelp" value="{{ $trabec->ahli_anestesi ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama asisten</label>
                                    <input type="email" class="form-control" name="asisten"
                                        aria-describedby="emailHelp" value="{{ $trabec->nama_asisten ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tindakan</label>
                                    <textarea type="email" class="form-control" name="tindakan" aria-describedby="emailHelp">{{ $trabec->tindakan ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Sebelum Operasi</label>
                                <input type="email" class="form-control" name="diagnosasebelum"
                                    aria-describedby="emailHelp" value="{{ $trabec->diagnosa_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa Paska Operasi</label>
                                <input type="email" class="form-control" name="diagnosapaska"
                                    aria-describedby="emailHelp" value="{{ $trabec->diagnosa_post_ops ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm">
                        @php
                            $periotomi_basis_split = isset($trabec->periotomi_basis)
                                ? explode('|', $trabec->periotomi_basis)
                                : [];
                            $per_1 = $periotomi_basis_split[0] ?? '';
                            $per_2 = $periotomi_basis_split[1] ?? '';

                            $antibiotik_split = isset($trabec->antibiotik) ? explode('|', $trabec->antibiotik) : [];
                            $ant_1 = $antibiotik_split[0] ?? '';
                            $ant_2 = $antibiotik_split[1] ?? '';
                        @endphp
                        <tr>
                            <td colspan="2">Laporan Operasi</td>
                        </tr>
                        <tr>
                            <td colspan="2">Dilakukan tindakan aseptik dan antiseptik</td>
                        </tr>
                        <tr>
                            <td colspan="2">Dilakukan Injeksi lidocain subtenon</td>
                        </tr>
                        <tr>
                            <td colspan="2">Dilakukan jahitan kendali</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Peritomi basis</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Fornix"
                                        value="1" {{ $per_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Fornix</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Limbal"
                                        value="1" {{ $per_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Limbal</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Serelal flap dibuat, ukuran </td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder=".......x......."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="Serelalflap" value="{{ $trabec->Serelalflap ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Parasentesis jam</td>
                        </tr>
                        <tr>
                            <td>Selerotomy dibuat, ukuran </td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder=".......x......."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="selerotomy" value="{{ $trabec->selerotomy ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">mm</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Iridektomi</td>
                        </tr>
                        <tr>
                            <td>Seleral Flap dijahit sebanyak </td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder=".............."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="banyakjahitan" value="{{ $trabec->banyakjahitan ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">jahitan</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">dengan benang</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder=".............."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="namabenang" value="{{ $trabec->namabenang ?? '' }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Konjungtiva dijahit sebanyak </td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder=".............."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="jlhjaitankonjungtiva"
                                        value="{{ $trabec->jlhjaitankonjungtiva ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">jahitan</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">dengan benang</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder=".............."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="namabenangkonjungtiva"
                                        value="{{ $trabec->namabenangkonjungtiva ?? '' }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Cek filtrasi</td>
                        </tr>
                        <tr>
                            <td colspan="2">Hidrasi sideport</td>
                        </tr>
                        <tr>
                            <td>Antibiotik</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Subkonjungtiva"
                                        value="1" {{ $ant_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Subkonjungtiva</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Topikal"
                                        value="1" {{ $ant_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Topikal</label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="save_laporan_op_trabeculektomi()"><i
                        class="bi bi-bookmarks"></i>
                    Simpan Laporan</button>
            </div>
        </div>
    </div>
    <div  class="card">
        <div class="card-header" id="headingSix">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
                    aria-controls="collapseSix">
                    <span class="text-bold">LAPORAN OPERASI PTERYGIUM</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($pter->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="form_laporanoperasipterygium">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input type="date" class="form-control" name="tgloperasi"
                                    aria-describedby="emailHelp" value="{{ $pter->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" name="jamoperasi"
                                    aria-describedby="emailHelp" value="{{ $pter->jam_mulai ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                                <input type="time" class="form-control" name="jamoperasiselesai"
                                    value="{{ $pter->jam_selesai ?? '00:00' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli bedah</label>
                                    <input type="email" class="form-control" name="ahlibedah"
                                        aria-describedby="emailHelp" value="{{ $pter->ahli_bedah ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli anestesi</label>
                                    <input type="email" class="form-control" name="ahlianestesi"
                                        aria-describedby="emailHelp" value="{{ $pter->ahli_anestesi ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama asisten</label>
                                    <input type="email" class="form-control" name="asisten"
                                        aria-describedby="emailHelp" value="{{ $pter->nama_asisten ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Perawat</label>
                                    <input type="email" class="form-control" name="perawat"
                                        aria-describedby="emailHelp" value="{{ $pter->nama_perawat ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                @php
                                    $pter_tindakan_split = isset($pter->tindakan) ? explode('|', $pter->tindakan) : [];
                                    $ptind_1 = $pter_tindakan_split[0] ?? '';
                                    $ptind_2 = $pter_tindakan_split[1] ?? '';
                                    $ptind_3 = $pter_tindakan_split[2] ?? '';
                                    $ptind_4 = $pter_tindakan_split[3] ?? '';
                                    $ptind_5 = $pter_tindakan_split[4] ?? '';
                                    $ptind_6 = $pter_tindakan_split[5] ?? '';

                                @endphp
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="NU"
                                        value="1" {{ $ptind_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">NU</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="RETROBULAR"
                                        value="1" {{ $ptind_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">RETROBULAR</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Peribular"
                                        value="1" {{ $ptind_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Peribular</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Topikal"
                                        value="1" {{ $ptind_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Topikal</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Subtenon"
                                        value="1" {{ $ptind_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Subtenon</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Subkonjungtiva"
                                        value="1" {{ $ptind_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox3">Subkonjungtiva</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa sebelum Operasi</label>
                                <input type="email" class="form-control" name="diagnosasebelum"
                                    aria-describedby="emailHelp" value="{{ $pter->diagnosa_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa paska Operasi</label>
                                <input type="email" class="form-control" name="diagnosapaska"
                                    aria-describedby="emailHelp" value="{{ $pter->diagnosa_post_ops ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama / Macam Operasi</label>
                                <textarea type="email" class="form-control" name="macamoperasi" aria-describedby="emailHelp">{{ $pter->macamoperasi ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jaringan yang dieksisi / insisi</label>
                                <textarea type="email" class="form-control" name="jaringaneksisi" aria-describedby="emailHelp">{{ $pter->jaringaneksisi ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Komplikasi atau penyulit </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi"
                                    id="inlineRadio1" value="0"
                                    {{ !isset($pter->komplikasi) || $pter->komplikasi == '0' || empty($pter->komplikasi) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="komplikasi"
                                    id="inlineRadio2" value="1"
                                    {{ isset($pter->komplikasi) && $pter->komplikasi == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Pemeriksaan PA </label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pemeriksaanpa"
                                    id="inlineRadio1" value="0"
                                    {{ !isset($pter->pemeriksaanpa) || $pter->pemeriksaanpa == '0' || empty($pter->pemeriksaanpa) ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pemeriksaanpa"
                                    id="inlineRadio2" value="1"
                                    {{ isset($pter->pemerikssaanpa) && $pter->pemerikssaanpa == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jumlah Darah yang keluar </label>
                                <input type="email" class="form-control" name="jumlah_darah_yang_keluar"
                                    aria-describedby="emailHelp"
                                    value="{{ $pter->jumlah_darah_yang_keluar ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <td colspan="2" class="text-bold text-center bg-light">Laporan Operasi</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Tindakan
                                aseptik
                                dan
                                antiseptik</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Injeksi
                                lidocain
                                subkonjungtiva</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Gunting
                                jaringan
                                pterygium dan pembersihan sisa jaringan dari kornea</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Perdarahan di
                                tangani
                                dengan cauter</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Injeksi
                                lidocaine
                                subkonjungtiva</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Pengambilan
                                graft
                                konjungtiva superior</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i> Perdarahan di
                                tangani
                                dengan cauter</td>
                        </tr>
                        <tr>
                            <td width="13%"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Pemasangan
                                graft, di
                                jahit sebanyak </td>
                            <td>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="jumlah jahitan ..."
                                        aria-label="Recipient's username" aria-describedby="basic-addon2"
                                        name="banyakjahitan" value="{{ $pter->banyakjahitan ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Buah/jahitan</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">Dengan benang</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        placeholder="masukan nama benang ..." aria-label="Recipient's username"
                                        aria-describedby="basic-addon2" name="namabenang"
                                        value="{{ $pter->namabenang ?? '' }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Pemberian salep
                                antibiotik</td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Operasi selesai
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="save_laporan_op_pterygium()"><i
                        class="bi bi-bookmarks"></i>
                    Simpan Laporan</button>
            </div>
        </div>

    </div>
    <div @if (auth()->user()->unit != '1014') hidden @endif class="card">
        <div class="card-header" id="headingSeven">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left d-flex justify-content-between align-items-center"
                    type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true"
                    aria-controls="collapseSeven">
                    <span class="text-bold">LAPORAN INJEKSI INTRA VITREAL</span>
                    <!-- Badge Petunjuk -->
                    <span class="badge badge-info p-2" style="font-size: 11px;">
                        <i class="fas fa-edit mr-1"></i> Klik untuk Isi Form
                    </span>
                </button>
            </h2>
        </div>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
            <div class="card-body">
                @if (isset($inj->pic))
                    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                        role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2 mr-3" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Peringatan!</strong> Laporan operasi ini sudah diisi 
                            <strong>Klik simpan jika ada data yang akan diubah.
                        </div>
                    </div>
                @endif
                <form action="" class="form_laporanoperasiinjeksiintra">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Operasi</label>
                                <input type="date" class="form-control" name="tgloperasi"
                                    aria-describedby="emailHelp" value="{{ $inj->tanggal_operasi ?? $date }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi dimulai</label>
                                <input type="time" class="form-control" name="jamoperasi"
                                    aria-describedby="emailHelp" value="{{ $inj->jam_mulai ?? '00:00' }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jam Operasi selesai</label>
                                <input type="time" class="form-control" name="jamselesai"
                                    aria-describedby="emailHelp" value="{{ $inj->jam_selesai ?? '00:00' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli bedah</label>
                                    <input type="email" class="form-control" name="ahlibedah"
                                        aria-describedby="emailHelp" value="{{ $inj->ahli_bedah ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama ahli anestesi</label>
                                    <input type="email" class="form-control" name="ahlianestesi"
                                        aria-describedby="emailHelp" value="{{ $inj->ahli_anestesi ?? '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama asisten</label>
                                    <input type="email" class="form-control" name="asisten"
                                        aria-describedby="emailHelp" value="{{ $inj->nama_asisten ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Jenis Anestesi</label>
                                    <textarea type="email" class="form-control" name="jenisanestesi" aria-describedby="emailHelp">{{ $inj->jenis_anestesi ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa sebelum Operasi</label>
                                <input type="email" class="form-control" name="diagnosasebelum"
                                    aria-describedby="emailHelp" value="{{ $inj->diagnosa_pre_ops ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diagnosa paska Operasi</label>
                                <input type="email" class="form-control" name="diagnosapaska"
                                    aria-describedby="emailHelp" value="{{ $inj->diagnosa_post_ops ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <table class="table table-sm">
                        @php
                            $inj_tindakan_split = isset($inj->tindakan) ? explode('|', $inj->tindakan) : [];
                            $inj_1 = $inj_tindakan_split[0] ?? '';
                            $inj_2 = $inj_tindakan_split[1] ?? '';
                            $inj_3 = $inj_tindakan_split[2] ?? '';
                            $inj_4 = $inj_tindakan_split[3] ?? '';
                            $inj_5 = $inj_tindakan_split[4] ?? '';
                            $inj_6 = $inj_tindakan_split[5] ?? '';
                            $inj_7 = $inj_tindakan_split[6] ?? '';

                        @endphp
                        <tr>
                            <td colspan="2" class="text-bold text-center bg-light">Laporan Operasi</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="injeksiantibiotik"
                                        value="1" {{ $inj_1 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Injeksi
                                        Antibiotik</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="injeksiantivegp"
                                        value="1" {{ $inj_2 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Injeksi anti
                                        VEGP</label>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Avastine"
                                        value="1" {{ $inj_3 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Avastine</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Patizra"
                                        value="1" {{ $inj_4 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Patizra</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="Eylea"
                                        value="1" {{ $inj_5 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Eylea</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Tindakan aseptik
                                dan
                                antiseptik dengan betadine</td>
                        </tr>
                        <tr>
                            <td><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Lokasi injeksi dari limbus</td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="4mm"
                                        value="1" {{ $inj_6 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">4 mm dari limbus
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="3mm"
                                        value="1" {{ $inj_7 == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">3 mm dari limbus
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Injeksi anti VEGF</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="jumlah_injeksiantivegf"
                                        value="{{ $inj->jumlah_injeksiantivegf ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">ml</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Injeksi antibiotik</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="jumlah_injeksiantibiotik"
                                        value="{{ $inj->jumlah_injeksiantibiotik ?? '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">ml</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Tetes mata
                                antibiotik
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><i class="bi bi-check-circle-fill mr-2 ml-2"></i>Balut</td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="save_laporan_op_injeksi_intra_vitreak()"><i
                        class="bi bi-bookmarks"></i>
                    Simpan Laporan</button>
            </div>
        </div>
    </div>
    <script>
        function sve() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan operasi akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata()
                }
            });
        }

        function simpandata() {
            var data1 = $('.formlaporanoperasi').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data1),
                    kodekunjungan
                },
                url: '<?= route('simpanhasiloperasi') ?>',
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
                    }
                }
            });
        }

        function simpandata_praop() {
            var data = $('.formlaporan_praoprasi').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpandatapraop') ?>',
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
                    }
                }
            });
        }

        function simpandata_opkatarak() {
            var data = $('.formlaporan_operasikatarak').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpandataopkatarak') ?>',
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
                    }
                }
            });
        }

        function simpandata_opkatarakglaukoma() {
            var data = $('.form_laporanoperasikatarakglaukoma').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpandataopkatarakglaukoma') ?>',
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
                    }
                }
            });
        }

        function simpandata_optrabeculektomi() {
            var data = $('.form_laporanoperasitrabeculektomi').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpanoptrabeculektomi') ?>',
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
                    }
                }
            });
        }

        function simpandata_oppterygium() {
            var data = $('.form_laporanoperasipterygium').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpanoppterygium') ?>',
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
                    }
                }
            });
        }

        function simpandata_injeksi_intra_vitreak() {
            var data = $('.form_laporanoperasiinjeksiintra').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data1: JSON.stringify(data),
                    kodekunjungan
                },
                url: '<?= route('simpanopinjeksi') ?>',
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
                    }
                }
            });
        }

        function save_laporan_pra_op() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Pengkajian Pra Bedah akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_praop()
                }
            });
        }

        function save_laporan_op_katarak() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Operasi Katarak akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_opkatarak()
                }
            });
        }

        function save_laporan_op_katarakglaukoma() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Operasi Katarak dan glaukoma akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_opkatarakglaukoma()
                }
            });
        }

        function save_laporan_op_trabeculektomi() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Operasi trabeculektomi akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_optrabeculektomi()
                }
            });
        }

        function save_laporan_op_pterygium() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Operasi pterygium akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_oppterygium()
                }
            });
        }

        function save_laporan_op_injeksi_intra_vitreak() {
            Swal.fire({
                title: "Anda yakin ?",
                text: "Laporan Operasi injeksi intra vitreal akan disimpan ...",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, simpan!"
            }).then((result) => {
                if (result.isConfirmed) {
                    simpandata_injeksi_intra_vitreak()
                }
            });
        }
    </script>
