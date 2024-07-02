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
                            <td>Hasil Pemeriksaan</td>
                            <td>
                                <textarea class="form-control" name="hasilperiksalain" id="hasilperiksalain" cols="30" rows="10"></textarea>
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
                            <td>Hasil Pemeriksaan</td>
                            <td>
                                <textarea class="form-control" name="hasilperiksalain" id="hasilperiksalain" cols="30" rows="10">{{ $hasil_ro[0]->tajampenglihatandekat }}</textarea>
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
                            <td colspan="3"><input class="form-control"
                                    value="{{ $hasil_ro_lama[0]->tgl_entry }}" id="konjungtiva"
                                    name="konjungtiva"></input></td>
                        </tr>
                        <tr>
                            <td>Hasil Pemeriksaan</td>
                            <td colspan="3">
                                <textarea rows="14" class="form-control" id="penglihatan_dekat" name="penglihatan_dekat">{{ $hasil_ro_lama[0]->tajampenglihatandekat }}</textarea>
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
                            <td colspan="3"><input class="form-control"
                                    value="{{ $hasil_ro_lama[0]->konjungtiva }}" id="konjungtiva"
                                    name="konjungtiva"></input></td>
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
                            <td colspan="3"><input class="form-control"
                                    value="{{ $hasil_ro_lama[0]->funduskopi }}" name="funduskopi"
                                    id="funduskopi"></input></td>
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
            url: '<?= route('simpanpemeriksaan_ro_2') ?>',
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
