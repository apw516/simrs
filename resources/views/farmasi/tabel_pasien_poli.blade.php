 <table id="tabelpasienpoli" class="table table-sm table-bordered table-hover text-xs">
     <thead class="bg-secondary">
         <th>Tgl Masuk</th>
         <th>No RM</th>
         <th>Nama PX</th>
         <th>Alamat</th>
         <th>---</th>
     </thead>
     <tbody>
         @foreach ($kunjungan as $k)
             <tr>
                 <td>{{ $k->tgl_masuk }}</td>
                 <td>{{ $k->no_rm }}</td>
                 <td>{{ $k->nama_pasien }}</td>
                 <td>{{ $k->alamat }}</td>
                 <td><button class="btn btn-success btn-sm pilihpasien" unit="{{ $k->kode_unit }}"
                         rm="{{ $k->no_rm }}"><i class="bi bi-box-arrow-down"></i></button></td>
             </tr>
         @endforeach
     </tbody>
 </table>
 <script>
     $(function() {
         $("#tabelpasienpoli").DataTable({
             "responsive": true,
             "lengthChange": false,
             "autoWidth": true,
             "pageLength": 6,
             "searching": true,
             "ordering": false,
         })
     });
     $(".pilihpasien").on('click', function(event) {
        $('.v_awal').attr('hidden',true)
        $('.v_kedua').removeAttr('hidden',true)
         rm = $(this).attr('rm')
         kodeunit = $(this).attr('unit')
         spinner = $('#loader')
         spinner.show();
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 rm,
                 kodeunit
             },
             url: '<?= route('ambil_detail_pasien') ?>',
             success: function(response) {
                 $('.v_select').html(response);
                 spinner.hide()
             }
         });
     });
 </script>
