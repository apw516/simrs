 <div class="card">
     <div class="card-body">
         <table id="tabelsrb" class="table table-bordered table-sm">
             <thead>
                 <th>Tanggal SRB</th>
                 <th>No SRB</th>
                 <th>No SEP</th>
                 <th>Nama</th>
                 <th>No Kartu</th>
                 <th>Alamat</th>
                 <th>Email</th>
                 <th>No Telpon</th>
                 <th>Nama program PRB</th>
                 <th>Nama Dokter</th>
                 <th>Keterangan</th>
                 <th>Saran</th>
                 <th></th>
             </thead>
             <tbody>
                 @if ($list->metaData->code == 200)
                     @foreach ($list->response->prb->list as $l)
                         <tr>
                             <td>{{ $l->tglSRB }}</td>
                             <td>{{ $l->noSRB }}</td>
                             <td>{{ $l->noSEP }}</td>
                             <td>{{ $l->peserta->nama }}</td>
                             <td>{{ $l->peserta->noKartu }}</td>
                             <td>{{ $l->peserta->alamat }}</td>
                             <td>{{ $l->peserta->email }}</td>
                             <td>{{ $l->peserta->noTelepon }}</td>
                             <td>{{ $l->programPRB->nama }}</td>
                             <td>{{ $l->DPJP->nama }}</td>
                             <td>{{ $l->keterangan }}</td>
                             <td>{{ $l->saran }}</td>
                             <td>
                                 <button nomorsrb="{{ $l->tglSRB }}" nomorsep="{{ $l->noSEP }}"
                                     class="badge badge-danger hapussrb"><i class="bi bi-trash"></i></button>
                                 <button nomorsrb="{{ $l->tglSRB }}" nomorsep="{{ $l->noSEP }}"
                                     class="badge badge-warning editsrb"><i class="bi bi-pencil-square"></i></button>
                                 <button data-saran="{{ $l->saran }}" data-keterangan="{{ $l->keterangan }}"  data-program="{{ $l->programPRB->nama }}" data-namapasien="{{ $l->peserta->nama }}" data-nomorkartu="{{ $l->peserta->noKartu }}" data-nomorsrb="{{ $l->noSRB }}" data-nomorsep="{{ $l->noSEP }}"
                                     class="badge badge-success editsrb">
                                     <i class="bi bi-printer"></i>
                                 </button>
                             </td>
                         </tr>
                     @endforeach
                 @endif
             </tbody>
         </table>
     </div>
 </div>


 <script>
     $(document).on('click', '.editsrb', function(e) {
         e.preventDefault();
         let noSrb = $(this).data('nomorsrb');
         let noSep = $(this).data('nomorsep');
         let nama = $(this).data('namapasien');
         let noka = $(this).data('nomorkartu');
         let namaProgram = $(this).data('program');
         let saran = $(this).data('saran');
         let keterangan = $(this).data('keterangan');
         // Ganti URL route di bawah ini sesuai dengan route cetak PRB di aplikasi Anda
         let urlCetak = "{{ url('/prb/cetak') }}?no_srb=" + noSrb + "&no_sep=" + noSep + "&nama=" + nama + "&noka=" + noka + "&namaprogram=" + namaProgram+ "&saran=" + saran + "&keterangan=" + keterangan;

         // Atau jika menggunakan route bernama Laravel:
         // let urlCetak = "{{ route('prb.cetak') }}?no_srb=" + noSrb + "&no_sep=" + noSep;

         // Membuka halaman cetak di TAB BARU
         window.open(urlCetak, '_blank');
     });
     $(function() {
         $("#tabelsrb").DataTable({
             "responsive": true,
             "lengthChange": false,
             "autoWidth": true,
             "pageLength": 8,
             "searching": true,
             "order": [
                 [7, "desc"]
             ]
         })
     });
     $('#tabelsuratkontrol_peserta2').on('click', '.hapussurat', function() {
         nomorsurat = $(this).attr('nomorsurat')
         Swal.fire({
             title: 'surat kontrol ' + nomorsurat,
             text: "Surat kontrol akan dihapus ?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya, Hapus',
             cancelButtonText: 'Tidak'
         }).then((result) => {
             if (result.isConfirmed) {
                 spinner = $('#loader')
                 spinner.show()
                 $.ajax({
                     type: 'post',
                     data: {
                         _token: "{{ csrf_token() }}",
                         nomorsurat,
                     },
                     dataType: 'Json',
                     Async: true,
                     url: '<?= route('vclaimhapussurkon') ?>',
                     error: function(data) {
                         spinner.hide()
                         Swal.fire({
                             icon: 'error',
                             title: 'Oops,silahkan coba lagi',
                         })
                     },
                     success: function(data) {
                         spinner.hide()
                         if (data.metaData.code == 200) {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil dihapus ...',
                             })
                             location.reload()
                         } else {
                             Swal.fire({
                                 icon: 'error',
                                 title: data.metaData.message,
                             })
                         }
                     }
                 });
             }
         });
     });
     $('#tabelsuratkontrol_peserta2').on('click', '.editsurat', function() {
         tgl = $(this).attr('tglkontrol')
         jenissurat = $(this).attr('jenissurat')
         suratkontrol = $(this).attr('suratkontrol')
         nomorsep = $(this).attr('nomorsep')
         nama = $(this).attr('nama')
         nomorkartu = $(this).attr('nomorkartu')
         namapolitujuan = $(this).attr('namapolitujuan')
         kodepolitujuan = $(this).attr('kodepolitujuan')
         namadokter = $(this).attr('namadokter')
         kodedokter = $(this).attr('kodedokter')
         $('#nomorkartu_update').val(nomorkartu)
         $('#nama_update').val(nama)
         $('#nomorsuratkontrol_update').val(suratkontrol)
         $('#nomorsep_update').val(nomorsep)
         $('#tanggalkontrol_update').val(tgl)
         $('#polikontrol_update').val(namapolitujuan)
         $('#kodepolikontrol_update').val(kodepolitujuan)
         $('#dokterkontrol_update').val(namadokter)
         $('#kodedokterkontrol_update').val(kodedokter)
         $('#jenis').val(jenissurat)
     });
 </script>
