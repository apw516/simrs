 <style>
     input[type="radio"] {
         -ms-transform: scale(1.5);
         /* IE 9 */
         -webkit-transform: scale(1.5);
         /* Chrome, Safari, Opera */
         transform: scale(1.5);
     }
 </style>
 @if (count($data_pk) > 0)
     @php
         $telingakiri = explode('|', $data_pk[0]->telingakiri);
         $telingakanan = explode('|', $data_pk[0]->telingakanan);
         $hidungkiri = explode('|', $data_pk[0]->hidungkiri);
         $hidungkanan = explode('|', $data_pk[0]->hidungkanan);
         $tenggorokan = explode('|', $data_pk[0]->RSI_TENGGOROKAN);
     @endphp
 @endif
 <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-header bg-secondary">Pemeriksaan Khusus</div>
             <div class="card-body">
                 <label for="exampleInputEmail1">Apakah ada pemeriksaan Khusus ?</label>
                 <select onchange="cekp()" class="form-control mb-4" id="cekpemeriksaankhusus" name="cekpemeriksaankhusus">
                 <option @if (count($data_assesment) > 0) @if ($data_assesment[0]->pemeriksaan_khusus == 0) selected @endif @else
                         selected @endif value="0">Tidak Ada</option>
                     <option @if (count($data_assesment) > 0) @if ($data_assesment[0]->pemeriksaan_khusus == 1) selected @endif
                         @endif value="1">Ada</option>
                 </select>
                 <div class="accordion" id="accordionExampletelinga">
                     <div class="card">
                         <div class="card-header" id="headingOnetelinga">
                             <h2 class="mb-0">
                                 <button disabled class="btn btn-link btn-block text-left text-dark text-bold collapsed"
                                     type="button" data-toggle="collapse" data-target="#collapseOnetelinga"
                                     aria-expanded="true" aria-controls="collapseOnetelinga">
                                     Pemeriksaan Telinga
                                 </button>
                             </h2>
                         </div>
                         <div id="collapseOnetelinga" class="collapse" aria-labelledby="headingOnetelinga"
                             data-parent="#accordionExampletelinga">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="card-header bg-dark">Telinga Kiri</div>
                                         <div class="card-body">
                                             <table class="table table-sm table-responsive">
                                                 <tr>
                                                     <td>Liang Telinga</td>
                                                     <td>
                                                         <div class="row">
                                                             @foreach ($penyakit as $p)
                                                                 @if ($p->sub_organ == 'Liang Telinga')
                                                                     <div class="col-md-4">
                                                                         <div class="form-group form-check">
                                                                             <input type="checkbox"
                                                                                 class="form-check-input"
                                                                                 name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                 value="1"
                                                                                 @if(count($data_pk) > 0)
                                                                                 @if ($telingakiri[0] == 1 && $p->nama_pemeriksaan == 'Lapang') checked
                                                                                @elseif($telingakiri[1] == 1 && $p->nama_pemeriksaan == 'Sempit')
                                                                                checked
                                                                                @elseif($telingakiri[2] == 1 && $p->nama_pemeriksaan == 'Destruksi')
                                                                                checked
                                                                                @elseif($telingakiri[3] == 1 && $p->nama_pemeriksaan == 'Serumen')
                                                                                checked
                                                                                @elseif($telingakiri[4] == 1 && $p->nama_pemeriksaan == 'Sekret')
                                                                                checked
                                                                                @elseif($telingakiri[5] == 1 && $p->nama_pemeriksaan == 'Jamur')
                                                                                checked
                                                                                @elseif($telingakiri[6] == 1 && $p->nama_pemeriksaan == 'Kolesteatoma')
                                                                                checked
                                                                                @elseif($telingakiri[7] == 1 && $p->nama_pemeriksaan == 'Massa atau Jaringan')
                                                                                checked
                                                                                @elseif($telingakiri[8] == 1 && $p->nama_pemeriksaan == 'Benda Asing')
                                                                                checked
                                                                                @elseif($telingakiri[9] == 1 && $p->nama_pemeriksaan == 'LT Lain-Lain')
                                                                                checked @endif @endif>
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="ltketeranganlainkiri"
                                                                 value="@if (count($data_pk) > 0) {{ $telingakiri[10] }} @endif">
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Membran Timpan</td>
                                                     <td>
                                                         <div class="row">
                                                             @foreach ($penyakit as $p)
                                                                 @if ($p->sub_organ == 'Membran Timpani')
                                                                     <div class="col-md-4">
                                                                         <div class="form-group form-check">
                                                                             <input type="checkbox"
                                                                                 class="form-check-input" id=""
                                                                                 name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                 value="1"
                                                                                 @if(count($data_pk) > 0)
                                                                                 @if ($telingakiri[11] == 1 && $p->nama_pemeriksaan == 'Intak - Normal') checked
                                                                                 @elseif($telingakiri[12] == 1 && $p->nama_pemeriksaan == 'Intak - Hiperemis')
                                                                                 checked
                                                                                 @elseif($telingakiri[13] == 1 && $p->nama_pemeriksaan == 'Intak - Bulging')
                                                                                 checked
                                                                                 @elseif($telingakiri[14] == 1 && $p->nama_pemeriksaan == 'Intak - Retraksi')
                                                                                 checked
                                                                                 @elseif($telingakiri[15] == 1 && $p->nama_pemeriksaan == 'Intak - Sklerotik')
                                                                                 checked
                                                                                 @elseif($telingakiri[16] == 1 && $p->nama_pemeriksaan == 'Perforasi - Sentral')
                                                                                 checked
                                                                                 @elseif($telingakiri[17] == 1 && $p->nama_pemeriksaan == 'Perforasi - Atik')
                                                                                 checked
                                                                                 @elseif($telingakiri[18] == 1 && $p->nama_pemeriksaan == 'Perforasi - Marginal')
                                                                                 checked
                                                                                 @elseif($telingakiri[19] == 1 && $p->nama_pemeriksaan == 'Perforasi - Lain-Lain')
                                                                                 checked @endif @endif>
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="mtketeranganlainkiri"
                                                                 value="@if (count($data_pk) > 0) {{ $telingakiri[20] }} @endif">

                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Kavum Timpani</td>
                                                     <td>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Mukosa</label>
                                                                 <input type="text" class="form-control"
                                                                     name="mukosakiri"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakiri[21] }} @endif">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Oslkel</label>
                                                                 <input type="text" class="form-control"
                                                                     name="oslkelkiri"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakiri[22] }} @endif">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Isthmus timpani/anterior
                                                                     timpani/posterior timpani</label>
                                                                 <input type="text" class="form-control"
                                                                     name="Isthmuskiri"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakiri[23] }} @endif">
                                                             </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Lain - Lain</td>
                                                     <td>
                                                         <textarea class="form-control" name="keteranganlainkiri">
@if (count($data_pk) > 0) {{ $telingakiri[24] }} @endif
</textarea>
                                                     </td>
                                                 </tr>
                                             </table>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="card-header bg-dark">Telinga Kanan</div>
                                         <div class="card-body">
                                             <table class="table table-sm table-responsive">
                                                 <tr>
                                                     <td>Liang Telinga</td>
                                                     <td>
                                                         <div class="row">
                                                             @foreach ($penyakit as $p)
                                                                 @if ($p->sub_organ == 'Liang Telinga')
                                                                     <div class="col-md-4">
                                                                         <div class="form-group form-check">
                                                                             <input type="checkbox"
                                                                                 class="form-check-input"
                                                                                 name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                 value="1"
                                                                                 @if (count($data_pk) > 0)
                                                                                 @if ($telingakanan[0] == 1 && $p->nama_pemeriksaan == 'Lapang') checked
                                                                                 @elseif($telingakanan[1] == 1 && $p->nama_pemeriksaan == 'Sempit')
                                                                                 checked
                                                                                 @elseif($telingakanan[2] == 1 && $p->nama_pemeriksaan == 'Destruksi')
                                                                                 checked
                                                                                 @elseif($telingakanan[3] == 1 && $p->nama_pemeriksaan == 'Serumen')
                                                                                 checked
                                                                                 @elseif($telingakanan[4] == 1 && $p->nama_pemeriksaan == 'Sekret')
                                                                                 checked
                                                                                 @elseif($telingakanan[5] == 1 && $p->nama_pemeriksaan == 'Jamur')
                                                                                 checked
                                                                                 @elseif($telingakanan[6] == 1 && $p->nama_pemeriksaan == 'Kolesteatoma')
                                                                                 checked
                                                                                 @elseif($telingakanan[7] == 1 && $p->nama_pemeriksaan == 'Massa atau Jaringan')
                                                                                 checked
                                                                                 @elseif($telingakanan[8] == 1 && $p->nama_pemeriksaan == 'Benda Asing')
                                                                                 checked
                                                                                 @elseif($telingakanan[9] == 1 && $p->nama_pemeriksaan == 'LT Lain-Lain')
                                                                                 checked @endif @endif>
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="ltketeranganlainkanan"
                                                                 value="@if (count($data_pk) > 0) {{ $telingakanan[10] }} @endif">
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Membran Timpan</td>
                                                     <td>
                                                         <div class="row">
                                                             @foreach ($penyakit as $p)
                                                                 @if ($p->sub_organ == 'Membran Timpani')
                                                                     <div class="col-md-4">
                                                                         <div class="form-group form-check">
                                                                             <input type="checkbox"
                                                                                 class="form-check-input"
                                                                                 id=""
                                                                                 name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                 value="1"
                                                                                 @if (count($data_pk) > 0)
                                                                                 @if ($telingakanan[11] == 1 && $p->nama_pemeriksaan == 'Intak - Normal') checked
                                                                                 @elseif($telingakanan[12] == 1 && $p->nama_pemeriksaan == 'Intak - Hiperemis')
                                                                                 checked
                                                                                 @elseif($telingakanan[13] == 1 && $p->nama_pemeriksaan == 'Intak - Bulging')
                                                                                 checked
                                                                                 @elseif($telingakanan[14] == 1 && $p->nama_pemeriksaan == 'Intak - Retraksi')
                                                                                 checked
                                                                                 @elseif($telingakanan[15] == 1 && $p->nama_pemeriksaan == 'Intak - Sklerotik')
                                                                                 checked
                                                                                 @elseif($telingakanan[16] == 1 && $p->nama_pemeriksaan == 'Perforasi - Sentral')
                                                                                 checked
                                                                                 @elseif($telingakanan[17] == 1 && $p->nama_pemeriksaan == 'Perforasi - Atik')
                                                                                 checked
                                                                                 @elseif($telingakanan[18] == 1 && $p->nama_pemeriksaan == 'Perforasi - Marginal')
                                                                                 checked
                                                                                 @elseif($telingakanan[19] == 1 && $p->nama_pemeriksaan == 'Perforasi - Lain-Lain')
                                                                                 checked @endif @endif>
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="mtketeranganlainkanan"
                                                                 value="@if (count($data_pk) > 0) {{ $telingakanan[20] }} @endif">

                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Kavum Timpani</td>
                                                     <td>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Mukosa</label>
                                                                 <input type="text" class="form-control"
                                                                     name="mukosakanan"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakanan[21] }} @endif">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Oslkel</label>
                                                                 <input type="text" class="form-control"
                                                                     name="oslkelkanan"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakanan[22] }} @endif">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Isthmus timpani/anterior
                                                                     timpani/posterior timpani</label>
                                                                 <input type="text" class="form-control"
                                                                     name="Isthmuskanan"
                                                                     value="@if (count($data_pk) > 0) {{ $telingakanan[23] }} @endif">
                                                             </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Lain - Lain</td>
                                                     <td>
                                                         <textarea class="form-control" name="keteranganlainkanan">
@if (count($data_pk) > 0) {{ $telingakanan[24] }} @endif
</textarea>
                                                     </td>
                                                 </tr>
                                             </table>
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <table class="table table-sm">
                                             <tr>
                                                 <td>Kesimpulan</td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <textarea class="form-control" id="kesimpulantelinga" name="kesimpulantelinga">
@if (count($data_pk) > 0) {{ $data_pk[0]->kesimpulantelinga }} @endif
</textarea>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Anjuran</td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <textarea class="form-control" id="anjurantelinga" name="anjurantelinga">
@if (count($data_pk) > 0) {{ $data_pk[0]->anjurantelinga }} @endif
</textarea>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-header" id="headingTwohidung">
                             <h2 class="mb-0">
                                 <button disabled
                                     class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                     type="button" data-toggle="collapse" data-target="#collapseTwohidung"
                                     aria-expanded="false" aria-controls="collapseTwohidung">
                                     Pemeriksaan Hidung
                                 </button>
                             </h2>
                         </div>
                         <div id="collapseTwohidung" class="collapse" aria-labelledby="headingTwohidung"
                             data-parent="#accordionExampletelinga">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="card">
                                             <div class="card-header text-bold bg-dark">Hidung Kiri</div>
                                             <div class="card-body">
                                                 <table class="table table-sm">
                                                     <tr>
                                                         <td>Kavum Nasi</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Kavum Nasi')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkiri[0] == 1 && $p->nama_pemeriksaan == 'Lapang') checked
                                                                                     @elseif ($hidungkiri[1] == 1 && $p->nama_pemeriksaan == 'Sempit') checked
                                                                                 @elseif($hidungkiri[2] == 1 && $p->nama_pemeriksaan == 'Mukosa Pucat')
                                                                                 checked
                                                                                 @elseif($hidungkiri[3] == 1 && $p->nama_pemeriksaan == 'Mukosa Hiperemis')
                                                                                 checked
                                                                                 @elseif($hidungkiri[4] == 1 && $p->nama_pemeriksaan == 'Kavum Nasi Mukosa Edema')
                                                                                 checked
                                                                                 @elseif($hidungkiri[5] == 1 && $p->nama_pemeriksaan == 'Massa')
                                                                                 checked
                                                                                 @elseif($hidungkiri[6] == 1 && $p->nama_pemeriksaan == 'Kavum Nasi Polip')
                                                                                 checked @endif @endif>
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Konka Inferior</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Konka Interior')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkiri[7] == 1 && $p->nama_pemeriksaan == 'Eutrofi') checked
                                                                                     @elseif ($hidungkiri[8] == 1 && $p->nama_pemeriksaan == 'Hipertrofi') checked
                                                                                 @elseif($hidungkiri[9] == 1 && $p->nama_pemeriksaan == 'Atrofi')
                                                                                 checked @endif @endif>
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Meatus Medius</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Meatus Medius')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkiri[10] == 1 && $p->nama_pemeriksaan == 'Terbuka') checked
                                                                                     @elseif ($hidungkiri[11] == 1 && $p->nama_pemeriksaan == 'Tertutup') checked
                                                                                 @elseif($hidungkiri[12] == 1 && $p->nama_pemeriksaan == 'Mukosa Edema')
                                                                                 checked @endif @endif>
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Septum</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Septum')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkiri[13] == 1 && $p->nama_pemeriksaan == 'Septum Polip') checked
                                                                                     @elseif ($hidungkiri[14] == 1 && $p->nama_pemeriksaan == 'Sekret') checked
                                                                                    @elseif($hidungkiri[15] == 1 && $p->nama_pemeriksaan == 'Lurus')
                                                                                    checked
                                                                                    @elseif($hidungkiri[16] == 1 && $p->nama_pemeriksaan == 'Deviasi')
                                                                                    checked
                                                                                    @elseif($hidungkiri[17] == 1 && $p->nama_pemeriksaan == 'Spina')
                                                                                    checked
                                                                                    @endif
                                                                                    @endif
                                                                                 >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Nasofaring</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Nasofaring')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="@if ($p->nama_pemeriksaan == 'Massa') ns @endif hidung{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkiri[18] == 1 && $p->nama_pemeriksaan == 'Normal') checked
                                                                                     @elseif ($hidungkiri[19] == 1 && $p->nama_pemeriksaan == 'Adenoid') checked
                                                                                    @elseif($hidungkiri[20] == 1 && $p->nama_pemeriksaan == 'Keradangan')
                                                                                    checked
                                                                                    @elseif($hidungkiri[21] == 1 && $p->nama_pemeriksaan == 'Massa')
                                                                                    checked
                                                                                    @endif
                                                                                    @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Lain - Lain</td>
                                                         <td>
                                                             <textarea class="form-control" name="lain-lainhidungkiri" id="lain-lainkiri">@if (count($data_pk) > 0) {{ $hidungkiri[22] }} @endif
                                                            </textarea>
                                                         </td>
                                                     </tr>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="card">
                                             <div class="card-header text-bold bg-dark">Hidung Kanan</div>
                                             <div class="card-body">
                                                 <table class="table table-sm">
                                                     <tr>
                                                         <td>Kavum Nasi</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Kavum Nasi')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkanan[0] == 1 && $p->nama_pemeriksaan == 'Lapang') checked
                                                                                     @elseif ($hidungkanan[1] == 1 && $p->nama_pemeriksaan == 'Sempit') checked
                                                                                    @elseif($hidungkanan[2] == 1 && $p->nama_pemeriksaan == 'Mukosa Pucat')
                                                                                    checked
                                                                                    @elseif($hidungkanan[3] == 1 && $p->nama_pemeriksaan == 'Mukosa Hiperemis')
                                                                                    checked
                                                                                    @elseif($hidungkanan[4] == 1 && $p->nama_pemeriksaan == 'Kavum Nasi Mukosa Edema')
                                                                                    checked
                                                                                    @elseif($hidungkanan[5] == 1 && $p->nama_pemeriksaan == 'Massa')
                                                                                    checked
                                                                                    @elseif($hidungkanan[6] == 1 && $p->nama_pemeriksaan == 'Kavum Nasi Polip')
                                                                                    checked @endif @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Konka Inferior</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Konka Interior')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkanan[7] == 1 && $p->nama_pemeriksaan == 'Eutrofi') checked
                                                                                     @elseif ($hidungkanan[8] == 1 && $p->nama_pemeriksaan == 'Hipertrofi') checked
                                                                                 @elseif($hidungkanan[9] == 1 && $p->nama_pemeriksaan == 'Atrofi')
                                                                                 checked @endif @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Meatus Medius</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Meatus Medius')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkanan[10] == 1 && $p->nama_pemeriksaan == 'Terbuka') checked
                                                                                     @elseif ($hidungkanan[11] == 1 && $p->nama_pemeriksaan == 'Tertutup') checked
                                                                                 @elseif($hidungkanan[12] == 1 && $p->nama_pemeriksaan == 'Mukosa Edema')
                                                                                 checked @endif @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Septum</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Septum')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="hidung{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkanan[13] == 1 && $p->nama_pemeriksaan == 'Septum Polip') checked
                                                                                     @elseif ($hidungkanan[14] == 1 && $p->nama_pemeriksaan == 'Sekret') checked
                                                                                    @elseif($hidungkanan[15] == 1 && $p->nama_pemeriksaan == 'Lurus')
                                                                                    checked
                                                                                    @elseif($hidungkanan[16] == 1 && $p->nama_pemeriksaan == 'Deviasi')
                                                                                    checked
                                                                                    @elseif($hidungkanan[17] == 1 && $p->nama_pemeriksaan == 'Spina')
                                                                                    checked
                                                                                    @endif
                                                                                    @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Nasofaring</td>
                                                         <td>
                                                             <div class="row">
                                                                 @foreach ($penyakit as $p)
                                                                     @if ($p->sub_organ == 'Nasofaring')
                                                                         <div class="col-md-4">
                                                                             <div class="form-group form-check">
                                                                                 <input type="checkbox"
                                                                                     class="form-check-input"
                                                                                     id=""
                                                                                     name="@if ($p->nama_pemeriksaan == 'Massa') ns @endif hidung{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1"
                                                                                     @if (count($data_pk) > 0)
                                                                                     @if ($hidungkanan[18] == 1 && $p->nama_pemeriksaan == 'Normal') checked
                                                                                     @elseif ($hidungkanan[19] == 1 && $p->nama_pemeriksaan == 'Adenoid') checked
                                                                                    @elseif($hidungkanan[20] == 1 && $p->nama_pemeriksaan == 'Keradangan')
                                                                                    checked
                                                                                    @elseif($hidungkanan[21] == 1 && $p->nama_pemeriksaan == 'Massa')
                                                                                    checked
                                                                                    @endif
                                                                                    @endif
                                                                                     >
                                                                                 <label class="form-check-label"
                                                                                     for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                             </div>
                                                                         </div>
                                                                     @endif
                                                                 @endforeach
                                                             </div>
                                                         </td>
                                                     </tr>
                                                     <tr>
                                                         <td>Lain - Lain</td>
                                                         <td>
                                                             <textarea class="form-control" name="lain-lainhidungkanan" id="lain-lainkanan">@if (count($data_pk) > 0) {{ $hidungkanan[22] }} @endif</textarea>
                                                         </td>
                                                     </tr>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <table class="table table-sm">
                                             <tr>
                                                 <td>Kesimpulan</td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <textarea class="form-control" id="kesimpulanhidung" name="kesimpulanhidung">@if (count($data_pk) > 0) {{ $data_pk[0]->kesimpulanhidung }} @endif</textarea>
                                                 </td>
                                             </tr>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-header" id="headingThreetenggorokan">
                             <h2 class="mb-0">
                                 <button disabled
                                     class="btn btn-link btn-block text-left collapsed text-dark text-bold"
                                     type="button" data-toggle="collapse" data-target="#collapseThreetenggorokan"
                                     aria-expanded="false" aria-controls="collapseThreetenggorokan">
                                     Pemeriksaan Tenggorokan
                                 </button>
                             </h2>
                         </div>
                         <div id="collapseThreetenggorokan" class="collapse"
                             aria-labelledby="headingThreetenggorokan" data-parent="#accordionExampletelinga">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="card">
                                             <div class="card-header bg-dark">REFLUX SYMPTOM INDEX ( RSI )</div>
                                             <div class="card-body">
                                                 Dalam 1 buah terakhir bagaimana gejala gejala ini mempengaruhi anda ?
                                                 Keterangan : 0 = Tidak Mengganggu 5 = Sangat Mengganggu
                                                 <table class="table table-bordered mt-3">
                                                     <tr>
                                                         <td>1</td>
                                                         <td>Suara serak dan masalah dengan suara</td>
                                                         <td>
                                                             <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="0"
                                                                 @if(count($data_pk) > 0 ) @if($tenggorokan[0] == 0) checked @endif @else checked @endif> 0
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[0] == 1)checked @endif @endif>1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[0] == 2)checked @endif @endif>2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[0] == 3)checked @endif @endif>3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[0] == 4)checked @endif @endif>4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[0] == 5)checked @endif @endif>5
                                                         </td>
                                                         <td width="5%"><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisuaraserak" name="nilaisuaraserak"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[1] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>2</td>
                                                         <td>Berdehem (Mengeluarkan dahak ditenggorokan)</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="0"
                                                                 @if(count($data_pk) > 0 ) @if($tenggorokan[2] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[2] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[2] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[2] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[2] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[2] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaiberdehem" name="nilaiberdehem"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[3] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>3</td>
                                                         <td>Banyak lendir ditenggorokan dan Post Nasal Drip</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="0"
                                                                 @if(count($data_pk) > 0 ) @if($tenggorokan[4] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[4] == 1)checked @endif @endif>1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[4] == 2)checked @endif @endif>2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[4] == 3)checked @endif @endif>3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[4] == 4)checked @endif @endif>4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[4] == 5)checked @endif @endif>5
                                                         </td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="niainasaldrip" name="nilainasaldrip"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[5] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>4</td>
                                                         <td>Sulit menelan makanan, minuman, obat ( pil )</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan" value="0"
                                                                 @if(count($data_pk) > 0 ) @if($tenggorokan[6] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="1"
                                                                 @if(count($data_pk) > 0 )  @if($tenggorokan[6] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="2"
                                                                 @if(count($data_pk) > 0 )  @if($tenggorokan[6] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="3"
                                                                 @if(count($data_pk) > 0 )  @if($tenggorokan[6] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="4"
                                                                 @if(count($data_pk) > 0 )  @if($tenggorokan[6] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="5"
                                                                 @if(count($data_pk) > 0 )  @if($tenggorokan[6] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisulitmenelan" name="nilaisulitmenelan"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[7] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>5</td>
                                                         <td>Batuk batuk setelah makan atau berbaring</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="0"
                                                                 @if(count($data_pk) > 0 ) @if($tenggorokan[8] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="1"  @if(count($data_pk) > 0 )  @if($tenggorokan[8] == 1)checked @endif @endif>1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="2"  @if(count($data_pk) > 0 )  @if($tenggorokan[8] == 2)checked @endif @endif>2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="3"  @if(count($data_pk) > 0 )  @if($tenggorokan[8] == 3)checked @endif @endif>3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="4"  @if(count($data_pk) > 0 )  @if($tenggorokan[8] == 4)checked @endif @endif>4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="5"  @if(count($data_pk) > 0 )  @if($tenggorokan[8] == 5)checked @endif @endif>5
                                                         </td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaibatukbatuk" name="nilaibatukbatuk"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[9] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>6</td>
                                                         <td>Sulit bernafas atau episode seperti tercekik</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[10] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[10] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[10] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[10] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[10] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[10] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisulitbernafas" name="nilaisulitbernafas"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[11] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>7</td>
                                                         <td>Masalah dengan batuk atau batuk yang mengganggu</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[12] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[12] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[12] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[12] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[12] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[12] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaibatukmengganggu" name="nilaibatukmengganggu"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[13] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>8</td>
                                                         <td>Rasa mengganjal atau banyak lendir ditenggorokan</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[14] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="1"  @if(count($data_pk) > 0 )  @if($tenggorokan[14] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="2"  @if(count($data_pk) > 0 )  @if($tenggorokan[14] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="3"  @if(count($data_pk) > 0 )  @if($tenggorokan[14] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="4"  @if(count($data_pk) > 0 )  @if($tenggorokan[14] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="5"  @if(count($data_pk) > 0 )  @if($tenggorokan[14] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 name="nilailendirtenggorokan"
                                                                 id="nilailendirtenggorokan" value="@if(count($data_pk) > 0) {{ $tenggorokan[15] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>9</td>
                                                         <td>Heartburn,nyeri dada, asam lambung naik</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[16] == 0) checked @endif @else checked @endif>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[16] == 1)checked @endif @endif>1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[16] == 2)checked @endif @endif>2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[16] == 3)checked @endif @endif>3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[16] == 4)checked @endif @endif>4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="5" @if(count($data_pk) > 0 )  @if($tenggorokan[16] == 5)checked @endif @endif>5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 name="nilaiasamlambungnaik" id="nilaiasamlambungnaik"
                                                                 value="@if(count($data_pk) > 0) {{ $tenggorokan[17] }} @endif"></td>
                                                     </tr>
                                                     <tr>
                                                         <td colspan="7" class="text-center text-bold">Total</td>
                                                         <td colspan="2"><input type="text"
                                                                 class="form-control" value="@if(count($data_pk) > 0) {{ $tenggorokan[18] }} @endif" name="totalrsi2"
                                                                 id="totalrsi2"></td>
                                                     </tr>
                                                 </table>
                                                 <table class="table table-sm table-bordered mt-3">
                                                     <thead class="bg-secondary">
                                                         <th>No</th>
                                                         <th>Keadaan Patologis Sekarang</th>
                                                         <th>Skor Patologis</th>
                                                         <th width="5%">∑</th>
                                                     </thead>
                                                     <tbody>
                                                         <tr>
                                                             <td>1</td>
                                                             <td>Edema Subglotik</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="edemasubglotik" id="edemasubglotik"
                                                                     value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[19] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemasubglotik" id="edemasubglotik"
                                                                     value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[19] == 2)checked @endif @endif> 2 = Ada</td>
                                                             <td><input type="text" class="form-control"
                                                                     rows="1" cols="1" value="@if(count($data_pk) > 0) {{ $tenggorokan[20] }} @endif"
                                                                     name="nilaiedema" id="nilaiedema"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>2</td>
                                                             <td>Obliterasi Ventrikular</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[21] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi"
                                                                     value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[21] == 2)checked @endif @endif>2 = Parsial <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi"
                                                                     value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[21] == 4)checked @endif @endif> 4 = Komplet</td>
                                                             <td><input type="text" class="form-control"
                                                                     name="nilaiobliterasi" id="nilaiobliterasi"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[22] }} @endif"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>3</td>
                                                             <td>Eritema / hiperemi</td>
                                                             <td><input class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[23] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[23] == 2)checked @endif @endif>2 =
                                                                 Hanya aritenoid <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[23] == 4)checked @endif @endif>4 =
                                                                 Difus
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[24] }} @endif" name="nilaieritema"
                                                                     id="nilaieritema"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>4</td>
                                                             <td>Edema pita suara</td>
                                                             <td>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="0" @if(count($data_pk) > 0 ) @if($tenggorokan[25] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[25] == 1)checked @endif @endif>1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[25] == 2)checked @endif @endif>2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[25] == 3)checked @endif @endif>3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[25] == 4)checked @endif @endif>4 =
                                                                 polipoid
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[26] }} @endif" name="nilaiedemapitasuara"
                                                                     id="nilaiedemapitasuara"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>5</td>
                                                             <td>Edema laring difus</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="0"  @if(count($data_pk) > 0 ) @if($tenggorokan[27] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br><input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[27] == 1)checked @endif @endif>1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[27] == 2)checked @endif @endif>2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[27] == 3)checked @endif @endif> 3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[27] == 4)checked @endif @endif>4 =
                                                                 obstruksi</td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[28] }} @endif" name="nilaiedemalaring"
                                                                     id="nilaiedemalaring"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>6</td>
                                                             <td>Hipertrofi komisura posterior</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[29] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br><input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[29] == 1)checked @endif @endif>1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[29] == 2)checked @endif @endif>2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[29] == 3)checked @endif @endif>3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="4" @if(count($data_pk) > 0 )  @if($tenggorokan[29] == 4)checked @endif @endif>4 =
                                                                 obstruksi</td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[30] }} @endif" name="nilaihipertrofi"
                                                                     id="nilaihipertrofi"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>7</td>
                                                             <td>Granuloma / jaringan granulasi</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Granuloma" id="Granuloma" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[31] == 0) checked @endif @else checked @endif>0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Granuloma" id="Granuloma" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[31] == 2)checked @endif @endif>2
                                                                 = ada </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[32] }} @endif" name="nilaigranuloma"
                                                                     id="nilaigranuloma"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>8</td>
                                                             <td>Mukus kental endolaring</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Mukus" id="Mukus" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[33] == 0) checked @endif @else checked @endif>0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Mukus" id="Mukus" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[33] == 2)checked @endif @endif>2 =
                                                                 ada </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[34] }} @endif" name="nilaimukus"
                                                                     id="nilaimukus"></td>
                                                         </tr>
                                                         <tr>
                                                             <td></td>
                                                             <td>Tonisila Lingualis</td>
                                                             <td>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila" value="0"
                                                                     @if(count($data_pk) > 0 ) @if($tenggorokan[35] == 0) checked @endif @else checked @endif> 0 = Tidak ada <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila"
                                                                     value="1" @if(count($data_pk) > 0 )  @if($tenggorokan[35] == 1)checked @endif @endif>Hipertrofi grade I <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila" value="2" @if(count($data_pk) > 0 )  @if($tenggorokan[35] == 2)checked @endif @endif>
                                                                 Hipertrofi grade II <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila"
                                                                     value="3" @if(count($data_pk) > 0 )  @if($tenggorokan[35] == 3)checked @endif @endif>Hipertrofi grade III
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[36] }} @endif" name="nilaitonisila"
                                                                     id="nilaitonisila"></td>
                                                         </tr>
                                                         <tr>
                                                             <td colspan="3">Total</td>
                                                             <td><input type="text" class="form-control"
                                                                     name="totalpatologis" id="totalpatologis"
                                                                     value="@if(count($data_pk) > 0) {{ $tenggorokan[37] }} @endif"></td>
                                                         </tr>
                                                     </tbody>
                                                 </table>
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
 <script>
     $('[name=suaraserak]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaisuaraserak').val(val)
         hitungtotalrsi()
     })
     $('[name=berdehem]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiberdehem').val(val)
         hitungtotalrsi()
     })
     $('[name=nasaldrip]').on('click', function(event) {
         val = $(this).attr('value')
         $('#niainasaldrip').val(val)
         hitungtotalrsi()
     })
     $('[name=sulitmenelan]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaisulitmenelan').val(val)
         hitungtotalrsi()
     })
     $('[name=batukbatuk]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaibatukbatuk').val(val)
         hitungtotalrsi()
     })
     $('[name=sulitbernafas]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaisulitbernafas').val(val)
         hitungtotalrsi()
     })
     $('[name=batukmengganggu]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaibatukmengganggu').val(val)
         hitungtotalrsi()
     })
     $('[name=lendirtenggorokan]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilailendirtenggorokan').val(val)
         hitungtotalrsi()
     })
     $('[name=asamlambungnaik]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiasamlambungnaik').val(val)
         hitungtotalrsi()
     })

     $('[name=edemasubglotik]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiedema').val(val)
         hitungtotalpatologis()
     })
     $('[name=Obliterasi]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiobliterasi').val(val)
         hitungtotalpatologis()
     })
     $('[name=Eritema]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaieritema').val(val)
         hitungtotalpatologis()
     })
     $('[name=Hipertrofi]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaihipertrofi').val(val)
         hitungtotalpatologis()
     })
     $('[name=Granuloma]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaigranuloma').val(val)
         hitungtotalpatologis()
     })
     $('[name=Mukus]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaimukus').val(val)
         hitungtotalpatologis()
     })
     $('[name=Tonisila]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaitonisila').val(val)
         hitungtotalpatologis()
     })
     $('[name=edemapitasuara]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiedemapitasuara').val(val)
         hitungtotalpatologis()
     })
     $('[name=edemalaring]').on('click', function(event) {
         val = $(this).attr('value')
         $('#nilaiedemalaring').val(val)
         hitungtotalpatologis()
     })
     $(document).ready(function() {
         cekp()
     })

     function cekp() {
         val1 = $('#cekpemeriksaankhusus').val()
         if (val1 == 1) {
             $('.collapsed').removeAttr('disabled', true)
         } else {
             $('.collapsed').attr('disabled', true)
         }
     }

     function hitungtotalpatologis() {
         a = parseInt($('#nilaiedema').val())
         b = parseInt($('#nilaiobliterasi').val())
         c = parseInt($('#nilaieritema').val())
         d = parseInt($('#nilaihipertrofi').val())
         e = parseInt($('#nilaigranuloma').val())
         f = parseInt($('#nilaimukus').val())
         g = parseInt($('#nilaitonisila').val())
         h = parseInt($('#nilaiedemapitasuara').val())
         i = parseInt($('#nilaiedemalaring').val())
         total = a + b + c + d + e + f + g + h + i
         $('#totalpatologis').val(total)
     }

     function hitungtotalrsi() {
         a = parseInt($('#nilaisuaraserak').val())
         b = parseInt($('#nilaiberdehem').val())
         c = parseInt($('#niainasaldrip').val())
         d = parseInt($('#nilaisulitmenelan').val())
         e = parseInt($('#nilaibatukbatuk').val())
         f = parseInt($('#nilaisulitbernafas').val())
         g = parseInt($('#nilaibatukmengganggu').val())
         h = parseInt($('#nilailendirtenggorokan').val())
         i = parseInt($('#nilaiasamlambungnaik').val())
         rsi = a + b + c + d + e + f + g + h + i
         $('#totalrsi2').val(rsi)
     }
 </script>
