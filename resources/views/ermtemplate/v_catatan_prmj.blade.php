 <table class="table table-sm table-bordered mt-2">
     <thead>
         <th>Tanggal / Jam</th>
         <th>DPJP</th>
         <th>Diagnosa Penting</th>
         <th>Uraian Klinis Penting</th>
         <th>Rencana Penting</th>
         <th>Remarks / Catatan Penting</th>
     </thead>
     <tbody>
         @foreach ($data as $r)
             <tr>
                 <td>{{ $r->tgl_entry }}</td>
                 <td>{{ $r->nama_dokter }}</td>
                 <td>{{ $r->diagnosis }}</td>
                 <td>{{ $r->uraian }}</td>
                 <td>{{ $r->rencana }}</td>
                 <td>{{ $r->catatan }}</td>

             </tr>
         @endforeach
     </tbody>
 </table>
