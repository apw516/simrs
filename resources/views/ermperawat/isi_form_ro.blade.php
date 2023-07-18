<div class="card">
    <div class="card-header bg-info">Form RO <button class="btn btn-warning float-right" data-toggle="modal"
            data-target="#modalhasil_kmrn"><i class="bi bi-eye mr-1 ml-1"></i> Hasil Sebelumnya</button></div>
    <div class="card-body">
        @if (count($resume_perawat) > 0)
            @if (count($hasil_ro) == 0)
                <form action="" class="formro_mata">
                    <input hidden type="text" class="form-control" name="idassesmen" id="idassesmen"
                        value="{{ $resume_perawat[0]->id }}">
                    <input hidden type="text" class="form-control" name="kodekunjungan" id="kodekunjungan"
                        value="{{ $resume_perawat[0]->kode_kunjungan }}">
                    <table class="table table-sm">
                        <tr>
                            <td rowspan="2">Visus Dasar</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OD</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" id="od_visus_dasar"
                                        name="od_visus_dasar" value="">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar"
                                        id="od_pinhole_visus_dasar" value="">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS</span>
                                    </div>
                                    <input name="os_visus_dasar" id="os_visus_dasar" value="" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                                        class="form-control" value="" aria-label="Amount (to the nearest dollar)">
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
                                    <input name="od_sph_refraktometer" value="" id="od_sph_refraktometer"
                                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input type="text" value="" id="od_cyl_refraktometer"
                                        name="od_cyl_refraktometer" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_refraktometer" value="" name="od_x_refraktometer"
                                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS : Sph</span>
                                    </div>
                                    <input id="os_sph_refraktometer" value="" name="os_sph_refraktometer"
                                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_refraktometer" value="" name="os_cyl_refraktometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_refraktometer" value="" name="os_x_refraktometer"
                                        type="text" class="form-control"
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
                                    <input id="od_sph_Lensometer" value="" name="od_sph_Lensometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="od_cyl_Lensometer" value="" name="od_cyl_Lensometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_Lensometer" value="" name="od_x_Lensometer" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS : Sph</span>
                                    </div>
                                    <input id="os_sph_Lensometer" value="" name="os_sph_Lensometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_Lensometer" value="" name="os_cyl_Lensometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_Lensometer" value="" name="os_x_Lensometer" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
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
                                    <input id="vod_sph_kpj" value="" name="vod_sph_kpj" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vod_cyl_kpj" value="" name="vod_cyl_kpj" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vod_x_kpj" value="" name="vod_x_kpj" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">VOS : Sph</span>
                                    </div>
                                    <input type="text" id="vos_sph_kpj" value="" name="vos_sph_kpj"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vos_cyl_kpj" value="" name="vos_cyl_kpj" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vos_x_kpj" value="" name="vos_x_kpj" type="text"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tajam penglihatan dekat</td>
                            <td colspan="3">
                                <textarea class="form-control" id="penglihatan_dekat" name="penglihatan_dekat"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Tekanan Intra Okular</td>
                            <td colspan="3">
                                <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan Pemeriksaan Lainnya</td>
                            <td colspan="3">
                                <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Palpebra</td>
                            <td colspan="3"><input class="form-control" value="" id="palpebra"
                                    name="palpebra"></input></td>
                        </tr>
                        <tr>
                            <td>Konjungtiva</td>
                            <td colspan="3"><input class="form-control" value="" id="konjungtiva"
                                    name="konjungtiva"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>Kornea</td>
                            <td colspan="3"><input class="form-control" value="" name="kornea"
                                    id="kornea"></input></td>
                        </tr>
                        <tr>
                            <td>Bilik Mata Depan</td>
                            <td colspan="3"><input class="form-control" value="" name="bilik_mata_depan"
                                    id="bilik_mata_depan"></input></td>
                        </tr>
                        <tr>
                            <td>Pupil</td>
                            <td colspan="3"><input class="form-control" value="" id="pupil"
                                    name="pupil"></input></td>
                        </tr>
                        <tr>
                            <td>Iris</td>
                            <td colspan="3"><input class="form-control" value="" name="iris"
                                    id="iris"></input></td>
                        </tr>
                        <tr>
                            <td>Lensa</td>
                            <td colspan="3"><input class="form-control" value="" name="lensa"
                                    id="lensa"></input></td>
                        </tr>
                        <tr>
                            <td>Funduskopi</td>
                            <td colspan="3"><input class="form-control" value="" name="funduskopi"
                                    id="funduskopi"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>Status Oftalmologis Khusus</td>
                            <td colspan="3">
                                <textarea class="form-control" value="" name="oftamologis" id="oftamologis"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Masalah Medis</td>
                            <td colspan="3">
                                <textarea class="form-control" value="" name="masalahmedis" id="masalahmedis"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Prognosis</td>
                            <td colspan="3">
                                <textarea class="form-control" value="" name="prognosis" id="prognosis"></textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            @else
                <form action="" class="formro_mata">
                    <input hidden type="text" class="form-control" name="idassesmen" id="idassesmen"
                        value="{{ $resume_perawat[0]->id }}">
                    <input hidden type="text" class="form-control" name="kodekunjungan" id="kodekunjungan"
                        value="{{ $resume_perawat[0]->kode_kunjungan }}">
                    <table class="table table-sm">
                        <tr>
                            <td rowspan="2">Visus Dasar</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OD</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" id="od_visus_dasar"
                                        name="od_visus_dasar" value="{{ $hasil_ro[0]->vd_od }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar"
                                        id="od_pinhole_visus_dasar" value="{{ $hasil_ro[0]->vd_od_pinhole }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS</span>
                                    </div>
                                    <input name="os_visus_dasar" id="os_visus_dasar"
                                        value="{{ $hasil_ro[0]->vd_os }}" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                                        class="form-control" value="{{ $hasil_ro[0]->vd_os_pinhole }}"
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
                                    <input name="od_sph_refraktometer"
                                        value="{{ $hasil_ro[0]->refraktometer_od_sph }}" id="od_sph_refraktometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input type="text" value="{{ $hasil_ro[0]->refraktometer_od_cyl }}"
                                        id="od_cyl_refraktometer" name="od_cyl_refraktometer" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_refraktometer" value="{{ $hasil_ro[0]->refraktometer_od_x }}"
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
                                    <input id="os_sph_refraktometer" value="{{ $hasil_ro[0]->refraktometer_os_sph }}"
                                        name="os_sph_refraktometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_refraktometer" value="{{ $hasil_ro[0]->refraktometer_os_cyl }}"
                                        name="os_cyl_refraktometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_refraktometer" value="{{ $hasil_ro[0]->refraktometer_os_x }}"
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
                                    <input id="od_sph_Lensometer" value="{{ $hasil_ro[0]->Lensometer_od_sph }}"
                                        name="od_sph_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="od_cyl_Lensometer" value="{{ $hasil_ro[0]->Lensometer_od_cyl }}"
                                        name="od_cyl_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_Lensometer" value="{{ $hasil_ro[0]->Lensometer_od_x }}"
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
                                    <input id="os_sph_Lensometer" value="{{ $hasil_ro[0]->Lensometer_os_sph }}"
                                        name="os_sph_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_Lensometer" value="{{ $hasil_ro[0]->Lensometer_os_cyl }}"
                                        name="os_cyl_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_Lensometer" value="{{ $hasil_ro[0]->Lensometer_os_x }}"
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
                                    <input id="vod_sph_kpj" value="{{ $hasil_ro[0]->koreksipenglihatan_vod_sph }}"
                                        name="vod_sph_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vod_cyl_kpj" value="{{ $hasil_ro[0]->koreksipenglihatan_vod_cyl }}"
                                        name="vod_cyl_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vod_x_kpj" value="{{ $hasil_ro[0]->koreksipenglihatan_vod_x }}"
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
                                    <input type="text" id="vos_sph_kpj"
                                        value="{{ $hasil_ro[0]->koreksipenglihatan_vos_sph }}" name="vos_sph_kpj"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vos_cyl_kpj" value="{{ $hasil_ro[0]->koreksipenglihatan_vos_cyl }}"
                                        name="vos_cyl_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vos_x_kpj" value="{{ $hasil_ro[0]->koreksipenglihatan_vos_x }}"
                                        name="vos_x_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tajam penglihatan dekat</td>
                            <td colspan="3">
                                <textarea class="form-control" id="penglihatan_dekat" name="penglihatan_dekat">{{ $hasil_ro[0]->tajampenglihatandekat }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Tekanan Intra Okular</td>
                            <td colspan="3">
                                <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $hasil_ro[0]->tekananintraokular }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan Pemeriksaan Lainnya</td>
                            <td colspan="3">
                                <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $hasil_ro[0]->catatanpemeriksaanlain }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Palpebra</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->palpebra }}"
                                    id="palpebra" name="palpebra"></input></td>
                        </tr>
                        <tr>
                            <td>Konjungtiva</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->konjungtiva }}"
                                    id="konjungtiva" name="konjungtiva"></input></td>
                        </tr>
                        <tr>
                            <td>Kornea</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->kornea }}"
                                    name="kornea" id="kornea"></input></td>
                        </tr>
                        <tr>
                            <td>Bilik Mata Depan</td>
                            <td colspan="3"><input class="form-control"
                                    value="{{ $hasil_ro[0]->bilikmatadepan }}" name="bilik_mata_depan"
                                    id="bilik_mata_depan"></input></td>
                        </tr>
                        <tr>
                            <td>Pupil</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->pupil }}"
                                    id="pupil" name="pupil"></input></td>
                        </tr>
                        <tr>
                            <td>Iris</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->iris }}"
                                    name="iris" id="iris"></input></td>
                        </tr>
                        <tr>
                            <td>Lensa</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->lensa }}"
                                    name="lensa" id="lensa"></input></td>
                        </tr>
                        <tr>
                            <td>Funduskopi</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro[0]->funduskopi }}"
                                    name="funduskopi" id="funduskopi"></input></td>
                        </tr>
                        <tr>
                            <td>Status Oftalmologis Khusus</td>
                            <td colspan="3">
                                <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $hasil_ro[0]->status_oftamologis_khusus }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Masalah Medis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $hasil_ro[0]->masalahmedis }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Prognosis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="prognosis" id="prognosis">{{ $hasil_ro[0]->prognosis }}</textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            @endif
            <button class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
        @else
            <h4>Perawat belum mengisi assesmen awal !</h4>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalhasil_kmrn" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Sebelumnya</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (count($hasil_ro_lama) > 0)
                    <table class="table table-sm">
                        <tr>
                            <td>Tgl Kunjungan</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->tgl_entry }}"
                                    id="konjungtiva" name="konjungtiva"></input></td>
                        </tr>
                        <tr>
                            <td rowspan="2">Visus Dasar</td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OD</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" id="od_visus_dasar"
                                        name="od_visus_dasar" value="{{ $hasil_ro_lama[0]->vd_od }}">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)" name="od_pinhole_visus_dasar"
                                        id="od_pinhole_visus_dasar" value="{{ $hasil_ro_lama[0]->vd_od_pinhole }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">OS</span>
                                    </div>
                                    <input name="os_visus_dasar" id="os_visus_dasar"
                                        value="{{ $hasil_ro_lama[0]->vd_os }}" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">PINHOLE</span>
                                    </div>
                                    <input name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                                        class="form-control" value="{{ $hasil_ro_lama[0]->vd_os_pinhole }}"
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
                                    <input name="od_sph_refraktometer"
                                        value="{{ $hasil_ro_lama[0]->refraktometer_od_sph }}" id="od_sph_refraktometer"
                                        type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input type="text" value="{{ $hasil_ro_lama[0]->refraktometer_od_cyl }}"
                                        id="od_cyl_refraktometer" name="od_cyl_refraktometer" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_refraktometer" value="{{ $hasil_ro_lama[0]->refraktometer_od_x }}"
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
                                    <input id="os_sph_refraktometer" value="{{ $hasil_ro_lama[0]->refraktometer_os_sph }}"
                                        name="os_sph_refraktometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_refraktometer" value="{{ $hasil_ro_lama[0]->refraktometer_os_cyl }}"
                                        name="os_cyl_refraktometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_refraktometer" value="{{ $hasil_ro_lama[0]->refraktometer_os_x }}"
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
                                    <input id="od_sph_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_od_sph }}"
                                        name="od_sph_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="od_cyl_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_od_cyl }}"
                                        name="od_cyl_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="od_x_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_od_x }}"
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
                                    <input id="os_sph_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_os_sph }}"
                                        name="os_sph_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="os_cyl_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_os_cyl }}"
                                        name="os_cyl_Lensometer" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="os_x_Lensometer" value="{{ $hasil_ro_lama[0]->Lensometer_os_x }}"
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
                                    <input id="vod_sph_kpj" value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vod_sph }}"
                                        name="vod_sph_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vod_cyl_kpj" value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vod_cyl }}"
                                        name="vod_cyl_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vod_x_kpj" value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vod_x }}"
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
                                    <input type="text" id="vos_sph_kpj"
                                        value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vos_sph }}" name="vos_sph_kpj"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Cyl</span>
                                    </div>
                                    <input id="vos_cyl_kpj" value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vos_cyl }}"
                                        name="vos_cyl_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                            <td>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input id="vos_x_kpj" value="{{ $hasil_ro_lama[0]->koreksipenglihatan_vos_x }}"
                                        name="vos_x_kpj" type="text" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Tajam penglihatan dekat</td>
                            <td colspan="3">
                                <textarea class="form-control" id="penglihatan_dekat" name="penglihatan_dekat">{{ $hasil_ro_lama[0]->tajampenglihatandekat }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Tekanan Intra Okular</td>
                            <td colspan="3">
                                <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $hasil_ro_lama[0]->tekananintraokular }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan Pemeriksaan Lainnya</td>
                            <td colspan="3">
                                <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $hasil_ro_lama[0]->catatanpemeriksaanlain }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Palpebra</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->palpebra }}"
                                    id="palpebra" name="palpebra"></input></td>
                        </tr>
                        <tr>
                            <td>Konjungtiva</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->konjungtiva }}"
                                    id="konjungtiva" name="konjungtiva"></input></td>
                        </tr>
                        <tr>
                            <td>Kornea</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->kornea }}"
                                    name="kornea" id="kornea"></input></td>
                        </tr>
                        <tr>
                            <td>Bilik Mata Depan</td>
                            <td colspan="3"><input class="form-control"
                                    value="{{ $hasil_ro_lama[0]->bilikmatadepan }}" name="bilik_mata_depan"
                                    id="bilik_mata_depan"></input></td>
                        </tr>
                        <tr>
                            <td>Pupil</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->pupil }}"
                                    id="pupil" name="pupil"></input></td>
                        </tr>
                        <tr>
                            <td>Iris</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->iris }}"
                                    name="iris" id="iris"></input></td>
                        </tr>
                        <tr>
                            <td>Lensa</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->lensa }}"
                                    name="lensa" id="lensa"></input></td>
                        </tr>
                        <tr>
                            <td>Funduskopi</td>
                            <td colspan="3"><input class="form-control" value="{{ $hasil_ro_lama[0]->funduskopi }}"
                                    name="funduskopi" id="funduskopi"></input></td>
                        </tr>
                        <tr>
                            <td>Status Oftalmologis Khusus</td>
                            <td colspan="3">
                                <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $hasil_ro_lama[0]->status_oftamologis_khusus }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Masalah Medis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $hasil_ro_lama[0]->masalahmedis }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Prognosis</td>
                            <td colspan="3">
                                <textarea class="form-control" name="prognosis" id="prognosis">{{ $hasil_ro_lama[0]->prognosis }}</textarea>
                            </td>
                        </tr>
                    </table>
                @else
                    Data tidak ditemukan !
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function simpanhasil() {
        var formro = $('.formro_mata').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                formro: JSON.stringify(formro)
            },
            url: '<?= route('simpanpemeriksaan_ro') ?>',
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
                    ambildatapasien()
                }
            }
        });
    }
</script>
