@if ($formkhusus['cek'] > 0)
<div class="row mt-2">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">Mata Kanan</div>
            <div class="card-body">
                <img src="{{ $formkhusus['mata'][0]->matakanan }}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning">Mata Kanan</div>
            <div class="card-body">
                <img src="{{ $formkhusus['mata'][0]->matakiri }}">
            </div>
        </div>
    </div>
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
                    <input readonly type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                        id="od_visus_dasar" name="od_visus_dasar" value="{{ $formkhusus['mata'][0]->vd_od }}">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">PINHOLE</span>
                    </div>
                    <input readonly type="text" class="form-control" aria-label="Amount (to the nearest dollar)"
                        name="od_pinhole_visus_dasar" id="od_pinhole_visus_dasar"
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
                    <input readonly name="os_visus_dasar" id="os_visus_dasar" value="{{ $formkhusus['mata'][0]->vd_os }}" type="text"
                        class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">PINHOLE</span>
                    </div>
                    <input readonly name="os_pinhole_visus_dasar" id="os_pinhole_visus_dasar" type="text"
                        class="form-control" value="{{ $formkhusus['mata'][0]->vd_os_pinhole }}"
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
                    <input readonly name="od_sph_refraktometer" value="{{ $formkhusus['mata'][0]->refraktometer_od_sph }}"
                        id="od_sph_refraktometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly type="text" value="{{ $formkhusus['mata'][0]->refraktometer_od_cyl }}" id="od_cyl_refraktometer"
                        name="od_cyl_refraktometer" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="od_x_refraktometer" value="{{ $formkhusus['mata'][0]->refraktometer_od_x }}"
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
                    <input readonly id="os_sph_refraktometer" value="{{ $formkhusus['mata'][0]->refraktometer_os_sph }}"
                        name="os_sph_refraktometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly id="os_cyl_refraktometer" value="{{ $formkhusus['mata'][0]->refraktometer_os_cyl }}"
                        name="os_cyl_refraktometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="os_x_refraktometer" value="{{ $formkhusus['mata'][0]->refraktometer_os_x }}"
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
                    <input readonly id="od_sph_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_od_sph }}"
                        name="od_sph_Lensometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly id="od_cyl_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_od_cyl }}"
                        name="od_cyl_Lensometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="od_x_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_od_x }}" name="od_x_Lensometer"
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
                    <input readonly id="os_sph_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_os_sph }}"
                        name="os_sph_Lensometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly id="os_cyl_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_os_cyl }}"
                        name="os_cyl_Lensometer" type="text" class="form-control"
                        aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="os_x_Lensometer" value="{{ $formkhusus['mata'][0]->Lensometer_os_x }}" name="os_x_Lensometer"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                    <input readonly id="vod_sph_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_sph }}" name="vod_sph_kpj"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly id="vod_cyl_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_cyl }}" name="vod_cyl_kpj"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="vod_x_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vod_x }}" name="vod_x_kpj"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">VOS : Sph</span>
                    </div>
                    <input readonly  type="text" id="vos_sph_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_sph }}"
                        name="vos_sph_kpj" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cyl</span>
                    </div>
                    <input readonly id="vos_cyl_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_cyl }}" name="vos_cyl_kpj"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                </div>
            </td>
            <td>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">X</span>
                    </div>
                    <input readonly id="vos_x_kpj" value="{{ $formkhusus['mata'][0]->koreksipenglihatan_vos_x }}" name="vos_x_kpj"
                        type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
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
                <textarea readonly class="form-control" name="catatan_pemeriksaan_lainnya"
                    id="catatan_pemerikssaan_lainnya">{{ $formkhusus['mata'][0]->catatanpemeriksaanlain }}</textarea>
            </td>
        </tr>
        <tr>
            <td>Palpebra</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->palpebra }}" id="palpebra"
                    name="palpebra"></input></td>
        </tr>
        <tr>
            <td>Konjungtiva</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->konjungtiva }}" id="konjungtiva"
                    name="konjungtiva"></input></td>
        </tr>
        <tr>
            <td>Kornea</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->kornea }}" name="kornea"
                    id="kornea"></input></td>
        </tr>
        <tr>
            <td>Bilik Mata Depan</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->bilikmatadepan }}"
                    name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
        </tr>
        <tr>
            <td>Pupil</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->pupil }}" id="pupil"
                    name="pupil"></input></td>
        </tr>
        <tr>
            <td>Iris</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->iris }}" name="iris"
                    id="iris"></input></td>
        </tr>
        <tr>
            <td>Lensa</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->lensa }}" name="lensa"
                    id="lensa"></input></td>
        </tr>
        <tr>
            <td>Funduskopi</td>
            <td colspan="3"><input class="form-control" readonly value="{{ $formkhusus['mata'][0]->funduskopi }}" name="funduskopi"
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
