 <style>
     input[type="radio"] {
         -ms-transform: scale(1.5);
         /* IE 9 */
         -webkit-transform: scale(1.5);
         /* Chrome, Safari, Opera */
         transform: scale(1.5);
     }
 </style>
 <div class="row">
     <div class="col-md-12">
         <div class="card">
             <div class="card-header bg-secondary">Pemeriksaan Khusus</div>
             <div class="card-body">
                 <div class="form-check form-check-inline mb-4">
                     <input class="form-check-input" type="radio" name="cekpemeriksaankhusus"
                         id="cekpemeriksaankhusus" value="0" selected>
                     <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                 </div>
                 <div class="form-check form-check-inline mb-4">
                     <input class="form-check-input" type="radio" name="cekpemeriksaankhusus"
                         id="cekpemeriksaankhusus" value="1">
                     <label class="form-check-label" for="1">Ada</label>
                 </div>
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
                                                                                 value="1">
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="ltketeranganlainkiri">
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
                                                                                 value="1">
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="mtketeranganlainkiri">

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
                                                                     name="mukosakiri">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Oslkel</label>
                                                                 <input type="text" class="form-control"
                                                                     name="oslkelkiri">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Isthmus timpani/anterior
                                                                     timpani/posterior timpani</label>
                                                                 <input type="text" class="form-control"
                                                                     name="Isthmuskiri">
                                                             </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Lain - Lain</td>
                                                     <td>
                                                         <textarea class="form-control" name="keteranganlainkiri"></textarea>
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
                                                                                 value="1">
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="ltketeranganlainkanan">
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
                                                                                 value="1">
                                                                             <label class="form-check-label"
                                                                                 for="exampleCheck1">{{ $p->nama_pemeriksaan }}</label>
                                                                         </div>
                                                                     </div>
                                                                 @endif
                                                             @endforeach
                                                             <input class="form-control" name="mtketeranganlainkanan">

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
                                                                     name="mukosakanan">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Oslkel</label>
                                                                 <input type="text" class="form-control"
                                                                     name="oslkelkanan">
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <label for="">Isthmus timpani/anterior
                                                                     timpani/posterior timpani</label>
                                                                 <input type="text" class="form-control"
                                                                     name="Isthmuskanan">
                                                             </div>
                                                         </div>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>Lain - Lain</td>
                                                     <td>
                                                         <textarea class="form-control" name="keteranganlainkanan"></textarea>
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
                                                     <textarea class="form-control" id="kesimpulantelinga" name="kesimpulantelinga"></textarea>
                                                 </td>
                                             </tr>
                                             <tr>
                                                 <td>Anjuran</td>
                                             </tr>
                                             <tr>
                                                 <td>
                                                     <textarea class="form-control" id="anjurantelinga" name="anjurantelinga"></textarea>
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kiri"
                                                                                     value="1">
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
                                                             <textarea class="form-control" name="lain-lainkiri" id="lain-lainkiri"></textarea>
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1">
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
                                                                                     name="{{ $p->nama_pemeriksaan }}kanan"
                                                                                     value="1">
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
                                                             <textarea class="form-control" name="lain-lainkanan" id="lain-lainkanan"></textarea>
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
                                                     <textarea class="form-control" id="kesimpulanhidung" name="kesimpulanhidung"></textarea>
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
                                                                 checked> 0
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="1">1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="2">2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="3">3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="4">4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="suaraserak" id="suaraserak" value="5">5
                                                         </td>
                                                         <td width="5%"><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisuaraserak" name="nilaisuaraserak"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>2</td>
                                                         <td>Berdehem (Mengeluarkan dahak ditenggorokan)</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="0"
                                                                 checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="berdehem" id="berdehem" value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaiberdehem" name="nilaiberdehem"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>3</td>
                                                         <td>Banyak lendir ditenggorokan dan Post Nasal Drip</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="0"
                                                                 checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="1">1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="2">2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="3">3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="4">4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="nasaldrip" id="nasaldrip" value="5">5
                                                         </td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="niainasaldrip" name="nilainasaldrip"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>4</td>
                                                         <td>Sulit menelan makanan, minuman, obat ( pil )</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan" value="0"
                                                                 checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitmenelan" id="sulitmenelan"
                                                                 value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisulitmenelan" name="nilaisulitmenelan"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>5</td>
                                                         <td>Batuk batuk setelah makan atau berbaring</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="0"
                                                                 checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="1">1
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="2">2
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="3">3
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="4">4
                                                         </td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukbatuk" id="batukbatuk" value="5">5
                                                         </td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaibatukbatuk" name="nilaibatukbatuk"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>6</td>
                                                         <td>Sulit bernafas atau episode seperti tercekik</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="0" checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="sulitbernafas" id="sulitbernafas"
                                                                 value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaisulitbernafas" name="nilaisulitbernafas"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>7</td>
                                                         <td>Masalah dengan batuk atau batuk yang mengganggu</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="0" checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="batukmengganggu" id="batukmengganggu"
                                                                 value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 id="nilaibatukmengganggu" name="nilaibatukmengganggu"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>8</td>
                                                         <td>Rasa mengganjal atau banyak lendir ditenggorokan</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="0" checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="lendirtenggorokan" id="lendirtenggorokan"
                                                                 value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 name="nilailendirtenggorokan"
                                                                 id="nilailendirtenggorokan" value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td>9</td>
                                                         <td>Heartburn,nyeri dada, asam lambung naik</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="0" checked>0</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="1">1</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="2">2</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="3">3</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="4">4</td>
                                                         <td> <input class="form-check-input" type="radio"
                                                                 name="asamlambungnaik" id="asamlambungnaik"
                                                                 value="5">5</td>
                                                         <td><input type="text"
                                                                 class="form-control form-control-sm"
                                                                 name="nilaiasamlambungnaik" id="nilaiasamlambungnaik"
                                                                 value="0"></td>
                                                     </tr>
                                                     <tr>
                                                         <td colspan="7" class="text-center text-bold">Total</td>
                                                         <td colspan="2"><input type="text"
                                                                 class="form-control" value="0" name="totalrsi2"
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
                                                                     value="0" checked> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemasubglotik" id="edemasubglotik"
                                                                     value="2"> 2 = Ada</td>
                                                             <td><input type="text" class="form-control"
                                                                     rows="1" cols="1" value="0"
                                                                     name="nilaiedema" id="nilaiedema"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>2</td>
                                                             <td>Obliterasi Ventrikular</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi" value="0"
                                                                     checked> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi"
                                                                     value="2">2 = Parsial <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Obliterasi" id="Obliterasi"
                                                                     value="4"> 4 = Komplet</td>
                                                             <td><input type="text" class="form-control"
                                                                     name="nilaiobliterasi" id="nilaiobliterasi"
                                                                     value="0"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>3</td>
                                                             <td>Eritema / hiperemi</td>
                                                             <td><input class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="0"
                                                                     checked> 0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="2">2 =
                                                                 Hanya aritenoid <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Eritema" id="Eritema" value="4">4 =
                                                                 Difus
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaieritema"
                                                                     id="nilaieritema"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>4</td>
                                                             <td>Edema pita suara</td>
                                                             <td>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="0" checked> 0 = Tidak ada <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="1">1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="2">2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="3">3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemapitasuara" id="edemapitasuara"
                                                                     value="4">4 =
                                                                 polipoid
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaiedemapitasuara"
                                                                     id="nilaiedemapitasuara"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>5</td>
                                                             <td>Edema laring difus</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="0" checked> 0 = Tidak ada <br><input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="1">1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="2">2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="3"> 3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="edemalaring" id="edemalaring"
                                                                     value="4">4 =
                                                                 obstruksi</td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaiedemalaring"
                                                                     id="nilaiedemalaring"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>6</td>
                                                             <td>Hipertrofi komisura posterior</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi" value="0"
                                                                     checked> 0 = Tidak ada <br><input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="1">1 = ringan <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="2">2 = sedang <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="3">3 = berat <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Hipertrofi" id="Hipertrofi"
                                                                     value="4">4 =
                                                                 obstruksi</td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaihipertrofi"
                                                                     id="nilaihipertrofi"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>7</td>
                                                             <td>Granuloma / jaringan granulasi</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Granuloma" id="Granuloma" value="0"
                                                                     checked>0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Granuloma" id="Granuloma" value="2">2
                                                                 = ada </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaigranuloma"
                                                                     id="nilaigranuloma"></td>
                                                         </tr>
                                                         <tr>
                                                             <td>8</td>
                                                             <td>Mukus kental endolaring</td>
                                                             <td> <input class="form-check-input" type="radio"
                                                                     name="Mukus" id="Mukus" value="0"
                                                                     checked>0 = Tidak ada <br> <input
                                                                     class="form-check-input" type="radio"
                                                                     name="Mukus" id="Mukus" value="2">2 =
                                                                 ada </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaimukus"
                                                                     id="nilaimukus"></td>
                                                         </tr>
                                                         <tr>
                                                             <td></td>
                                                             <td>Tonisila Lingualis</td>
                                                             <td>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila" value="0"
                                                                     checked> 0 = Tidak ada <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila"
                                                                     value="1">Hipertrofi grade I <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila" value="2">
                                                                 Hipertrofi grade II <br>
                                                                 <input class="form-check-input" type="radio"
                                                                     name="Tonisila" id="Tonisila"
                                                                     value="3">Hipertrofi grade III
                                                             </td>
                                                             <td><input type="text" class="form-control"
                                                                     value="0" name="nilaitonisila"
                                                                     id="nilaitonisila"></td>
                                                         </tr>
                                                         <tr>
                                                             <td colspan="3">Total</td>
                                                             <td><input type="text" class="form-control"
                                                                     name="totalpatologis" id="totalpatologis"
                                                                     value="0"></td>
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
     $('[name=cekpemeriksaankhusus]').on('click', function(event) {
         value1 = $('#cekpemeriksaankhusus:selected').val();
     })
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
