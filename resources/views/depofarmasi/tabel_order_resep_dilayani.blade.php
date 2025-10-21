 <div class="card">
     <div class="card-header">List Orderan diterima</div>
     <div class="card-body">
         <table class="table table-sm table-bordered table-hover">
             <thead>
                 <th>Nomor Antrian</th>
                 <th>Nomor RM</th>
                 <th>Nama Pasien</th>
                 <th>Unit Asal</th>
                 <th>Status Antrian</th>
                 <th>Action</th>
             </thead>
             <tbody>
                 @foreach ($dataorder as $d)
                     <tr>
                         <td>{{ $d->kode_antrian }} - {{ $d->nomor_urut }}</td>
                         <td>{{ $d->no_rm }}</td>
                         <td>{{ $d->nama_pasien }}</td>
                         <td>{{ $d->nama_unit_asal }}</td>
                         <td>
                             @if ($d->status_antrian == 0)
                                 Belum diterima
                             @elseif($d->status_antrian == 1)
                                 Sedang dilayani
                             @elseif($d->status_antrian == 2)
                                 Sudah diberikan
                             @endif
                         </td>
                         <td>
                             <button class="btn btn-info detailresepditerima" idorder="{{ $d->id }}"
                                 data-toggle="modal" data-target="#modalorderandilayani"><i
                                     class="bi bi-ticket-detailed"></i></button>
                            <button idorder="{{ $d->id }}" class="btn btn-success layani"><i class="bi bi-folder-plus"></i></button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
 <!-- Modal -->
 <div class="modal fade" id="modalorderandilayani" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Resep yang sudah dilayani</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="v_obat_nya">

                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     $(".detailresep").on('click', function(event) {
         idorder = $(this).attr('idorder')
         $('.v_1').attr('hidden', true)
         $(".v_2").removeAttr('hidden', true);
         spinneron()
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 idorder
             },
             url: '<?= route('detailorderan') ?>',
             error: function(response) {
                 spinnerof()
             },
             success: function(response) {
                 spinnerof()
                 $('.v_2').html(response);
             }
         });
     })
     $(".detailresepditerima").on('click', function(event) {
         idorder = $(this).attr('idorder')
         spinneron()
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 idorder
             },
             url: '<?= route('detailorderanditerima') ?>',
             error: function(response) {
                 spinnerof()
             },
             success: function(response) {
                 spinnerof()
                 $('.v_obat_nya').html(response);
             }
         });
     })
       $(".layani").on('click', function(event) {
         idorder = $(this).attr('idorder')
         $('.v_1').attr('hidden', true)
         $(".v_2").removeAttr('hidden', true);
         spinneron()
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 idorder
             },
             url: '<?= route('detailorderan') ?>',
             error: function(response) {
                 spinnerof()
             },
             success: function(response) {
                 spinnerof()
                 $('.v_2').html(response);
             }
         });
     })
 </script>
