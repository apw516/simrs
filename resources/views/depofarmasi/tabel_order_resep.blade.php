 <div class="card">
     <div class="card-header">List Orderan Masuk</div>
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
                                 Sudah diterima
                             @endif
                         </td>
                         <td>
                             <button class="btn btn-info detailorder" idorder="{{ $d->id }}">Detail</button>
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </div>
 </div>
 <script>
     $(".detailorder").on('click', function(event) {
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
