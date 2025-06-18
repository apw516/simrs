   <table id="tabelracikan"class="table table-sm table-bordered text-xs table-responsive">
       <thead>
           <th>Nama Racikan</th>
           <th>Keterangan</th>
           <th>Tipe Racikan</th>
           <th>Kemasan</th>
           <th>Jumlah</th>
           <th>Aturan Pakai</th>
           <th width="10%"></th>
       </thead>
       <tbody>
           @foreach ($templateracikan as $R)
               <tr>
                   <td>{{ $R->nama_racikan }} </td>
                   <td>{{ $R->keterangan }}</td>
                   <td>{{ $R->tiperacikan }}</td>
                   <td>{{ $R->kemasan }}</td>
                   <td>{{ $R->jumlah }}</td>
                   <td>{{ $R->aturanpakai }}</td>
                   <td class="text-center">
                       <button class="btn btn-sm btn-danger hapustemplate" idheader="{{ $R->id }}"><i
                               class="bi bi-trash-fill"></i></button>
                       <button class="btn btn-sm btn-success pilihracikan" idheader="{{ $R->id }}"><i
                               class="bi bi-hand-thumbs-up"></i></button>
                   </td>
               </tr>
           @endforeach
       </tbody>
   </table>
   <script>
       $(function() {
           $("#tabelracikan").DataTable({
               "responsive": false,
               "lengthChange": false,
               "autoWidth": true,
               "pageLength": 10,
               "searching": true,
               "ordering": false,
           })
       });
       $(".hapustemplate").on('click', function(event) {
           idheader = $(this).attr('idheader')
           Swal.fire({
               title: "Anda yakin ?",
               text: "Data template racikan akan dihapus ...",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Ya , Hapus template .."
           }).then((result) => {
               if (result.isConfirmed) {
                   hapustemplateracik(idheader)
               }
           });
       })
       $(".pilihracikan").on('click', function(event) {
           idheader = $(this).attr('idheader')
           $('#modaltemplateobatracik').modal('hide');
           pilihracikan(idheader)
       })

       function hapustemplateracik(idheader) {
           spinneron()
           $.ajax({
               async: true,
               type: 'post',
               dataType: 'json',
               data: {
                   _token: "{{ csrf_token() }}",
                   idheader
               },
               url: '<?= route('hapustemplateracik') ?>',
               error: function(data) {
                   spinnerof()
                   Swal.fire({
                       icon: 'error',
                       title: 'Ooops....',
                       text: 'Sepertinya ada masalah......',
                       footer: ''
                   })
               },
               success: function(data) {
                   spinnerof()
                   $('#modaltemplateobatracik').modal('hide');
               }
           });
       }

       function pilihracikan(idheader) {
           spinner = $('#loader')
           spinner.show();
           var max_fields = 10;
           // var wrapper = $(".input_komponen_obat_racik");
           var wrapper = $(".draft_obat2");
           var x = 1;
           if (x < max_fields) {
               x++; //text box increment
               $.ajax({
                   type: 'post',
                   data: {
                       _token: "{{ csrf_token() }}",
                       idheader
                   },
                   url: '<?= route('ambil_detail_template_racikan') ?>',
                   success: function(response) {
                       // wrapper.after(html);
                       // $('#daftarpxumum').attr('disabled', true);
                       $(wrapper).append(response);
                       $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                           e.preventDefault();
                           $(this).parent('div').remove();
                           x--;
                       })
                       spinner.hide();
                   }
               });
           }
       }
   </script>
