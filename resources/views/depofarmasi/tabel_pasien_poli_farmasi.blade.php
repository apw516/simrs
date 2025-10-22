 <table id="tabelpasienpoli" class="table table-sm table-bordered table-hover text-xs">
     <thead class="bg-secondary">
         <th>Tgl Masuk</th>
         <th>No RM</th>
         <th>Nama PX</th>
         <th>Nama Unit</th>
         <th>Alamat</th>
         <th>---</th>
     </thead>
     <tbody>
         @foreach ($kunjungan as $k)
             <tr>
                 <td>{{ $k->tgl_masuk }}</td>
                 <td>{{ $k->no_rm }}</td>
                 <td>{{ $k->nama_pasien }}</td>
                 <td>{{ $k->nama_unit }}</td>
                 <td>{{ $k->alamat }}</td>
                 <td><button class="btn btn-success btn-sm pilihpasien" unit="{{ $k->kode_unit }}"
                         rm="{{ $k->no_rm }}" kodekunjungan="{{ $k->kode_kunjungan }}"><i class="bi bi-box-arrow-down"></i></button></td>
             </tr>
         @endforeach
     </tbody>
 </table>
 <script>
     $(function() {
         $("#tabelpasienpoli").DataTable({
             "responsive": false,
             "lengthChange": false,
             "autoWidth": true,
             "pageLength": 6,
             "searching": true,
             "ordering": false,
         })
     });
     $(".pilihpasien").on('click', function(event) {
        $('.v_1').attr('hidden',true)
        $('.v_2').removeAttr('hidden',true)
         rm = $(this).attr('rm')
         kodeunit = $(this).attr('unit')
         kodekunjungan = $(this).attr('kodekunjungan')
         spinner = $('#loader')
         spinner.show();
         $.ajax({
             type: 'post',
             data: {
                 _token: "{{ csrf_token() }}",
                 rm,
                 kodeunit,
                 kodekunjungan
             },
             url: '<?= route('detailorderan3') ?>',
             success: function(response) {
                 $('.v_2').html(response);
                 spinner.hide()
             }
         });
     });
 </script>
