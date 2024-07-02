 <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-header bg-secondary">Pemeriksaan Khusus</div>
             <div class="card-body">
                 @if (count($RO_MATA) > 0)
                     <table class="table table-sm">
                         <input hidden type="text" class="form-control" id="id_ro" name="id_ro"
                             value="{{ $RO_MATA[0]->id }}">
                         <tr>
                             <td>Hasil pemerikssaan RO</td>
                             <td colspan="3">
                                 <textarea class="form-control" rows="8" id="hasilperiksalain" name="hasilperiksalain">{{ trim($RO_MATA[0]->tajampenglihatandekat) }}</textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>Tekanan Intra Okular</td>
                             <td colspan="3">
                                 <textarea class="form-control" id="tekanan_intra_okular" name="tekanan_intra_okular">{{ $RO_MATA[0]->tekananintraokular }}</textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>Catatan Pemeriksaan Lainnya</td>
                             <td colspan="3">
                                 <textarea class="form-control" name="catatan_pemeriksaan_lainnya" id="catatan_pemerikssaan_lainnya">{{ $RO_MATA[0]->catatanpemeriksaanlain }}</textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>Palpebra</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->palpebra }}"
                                     id="palpebra" name="palpebra"></input></td>
                         </tr>
                         <tr>
                             <td>Konjungtiva</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->konjungtiva }}"
                                     id="konjungtiva" name="konjungtiva"></input></td>
                         </tr>
                         <tr>
                             <td>Kornea</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->kornea }}"
                                     name="kornea" id="kornea"></input></td>
                         </tr>
                         <tr>
                             <td>Bilik Mata Depan</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->bilikmatadepan }}"
                                     name="bilik_mata_depan" id="bilik_mata_depan"></input></td>
                         </tr>
                         <tr>
                             <td>Pupil</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->pupil }}"
                                     id="pupil" name="pupil"></input></td>
                         </tr>
                         <tr>
                             <td>Iris</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->iris }}"
                                     name="iris" id="iris"></input></td>
                         </tr>
                         <tr>
                             <td>Lensa</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->lensa }}"
                                     name="lensa" id="lensa"></input></td>
                         </tr>
                         <tr>
                             <td>Funduskopi</td>
                             <td colspan="3"><input class="form-control" value="{{ $RO_MATA[0]->funduskopi }}"
                                     name="funduskopi" id="funduskopi"></input></td>
                         </tr>
                         <tr>
                             <td>Status Oftalmologis Khusus</td>
                             <td colspan="3">
                                 <textarea class="form-control" name="oftamologis" id="oftamologis">{{ $RO_MATA[0]->status_oftamologis_khusus }}</textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>Masalah Medis</td>
                             <td colspan="3">
                                 <textarea class="form-control" name="masalahmedis" id="masalahmedis">{{ $RO_MATA[0]->masalahmedis }}</textarea>
                             </td>
                         </tr>
                         <tr>
                             <td>Prognosis</td>
                             <td colspan="3">
                                 <textarea class="form-control" name="prognosis" id="prognosis">{{ $RO_MATA[0]->prognosis }}</textarea>
                             </td>
                         </tr>
                     </table>
                 @else
                     <table class="table table-sm">
                         <input hidden type="text" class="form-control" id="id_ro" name="id_ro" value="0">
                         <tr>
                             <td>Hasil pemerikssaan RO</td>
                             <td colspan="3">
                                 <textarea class="form-control" rows="8" id="hasilperiksalain" name="hasilperiksalain"></textarea>
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
                 @endif
             </div>
         </div>
     </div>
 </div>
