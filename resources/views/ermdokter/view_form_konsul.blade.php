   <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
   <p class="text-danger">*klik form konsul atau rujuk internal untuk pasien yang harus konsul ke poli lain atau rujuk ke
       poli lain ...</p>
   <div class="btn-group" role="group" aria-label="Basic example">
       <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalkonsulpolilain"><i
               class="bi bi-journal mr-1 ml-1"></i> Form Konsul
           Poli Lain</button>
       <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalrujukinternal"><i
               class="bi bi-journal mr-1 ml-1"></i> Form Rujuk
           Internal</button>
   </div>
   <div class="modal fade" id="modalkonsulpolilain" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Form Konsul Poli Lain</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="col-12">
                       <div class="form-group">
                           <label>Silahkan Pilih Poli Tujuan :</label>
                           <select class="select2" multiple="multiple" data-placeholder="Pilih poli konsul ..."
                               style="width: 80%;" id="polikonsul" name="polikonsul">
                               @foreach ($mt_unit as $u)
                                   <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>
                   <div class="col-md-12 mt-2">
                       <div class="form-group">
                           <label for="exampleFormControlTextarea1">Catatan Konsul</label>
                           <textarea class="form-control" id="catatankonsul" name="catatankonsul" rows="3"></textarea>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary" onclick="simpankonsul()">Simpan</button>
               </div>
           </div>
       </div>
   </div>
   <!-- Modal -->
   <div class="modal fade" id="modalrujukinternal" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog modal-xl">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Form Rujuk Internal</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <div class="col-12">
                       <div class="form-group">
                           <label>Silahkan Pilih Poli Tujuan :</label>
                           <select class="select2" multiple="multiple" data-placeholder="Pilih poli rujuk internal ..."
                               style="width: 80%;" id="polirujin" name="polirujin">
                               @foreach ($mt_unit as $u)
                                   <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>
                   <div class="col-md-12 mt-2">
                       <div class="form-group">
                           <label for="exampleFormControlTextarea1">Catatan rujuk</label>
                           <textarea class="form-control" id="catatanrujuk" name="catatanrujuk" rows="3"></textarea>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="button" class="btn btn-primary" onclick="simpanrujin()">simpan</button>
               </div>
           </div>
       </div>
   </div>
   <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
   <script>
       $(function() {
           $('.select2').select2()
       });

       function simpankonsul() {
           kodekunjungan = $('#kodekunjungan').val()
           kodeunit = $('#polikonsul').val()
           catatankonsul = $('#catatankonsul').val()
           spinner = $('#loader')
           spinner.show();
           $.ajax({
               async: true,
               type: 'post',
               dataType: 'json',
               data: {
                   _token: "{{ csrf_token() }}",
                   kodeunit,
                   catatankonsul,
                   kodekunjungan
               },
               url: '<?= route('simpankonsul_baru') ?>',
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
                       ambilformkonsul()
                       $('#modalkonsulpolilain').modal('toggle');
                   }
               }
           });
       }

       function simpanrujin() {
           kodekunjungan = $('#kodekunjungan').val()
           kodeunit = $('#polirujin').val()
           catatanrujuk = $('#catatanrujuk').val()
           spinner = $('#loader')
           spinner.show();
           $.ajax({
               async: true,
               type: 'post',
               dataType: 'json',
               data: {
                   _token: "{{ csrf_token() }}",
                   kodeunit,
                   catatanrujuk,
                   kodekunjungan
               },
               url: '<?= route('simpanrujin_baru') ?>',
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
                       ambilformkonsul()
                       $('#modalrujukinternal').modal('toggle');
                   }
               }
           });
       }
   </script>
