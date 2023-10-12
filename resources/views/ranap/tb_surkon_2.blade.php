<table id="tbsrk" class="table table-sm table-bordered text-xs table-hover table-stripped">
    <thead>
        <th>Nomor Kartu</th>
        <th>Nama</th>
        <th>Nomor Surat Kontrol</th>
        <th>Jenis Pelayanan</th>
        <th>Jenis Surat</th>
        <th>Tanggal Rencana Kontrol</th>
        <th>Tanggal Terbit Surat</th>
        <th>SEP asal</th>
        <th>Poli Tujuan</th>
        <th>Dokter</th>
        <th>Terpakai</th>
    </thead>
    <tbody>
        @if ($suratkontrol->metaData->code == 200)
            @foreach ($suratkontrol->response->list as $s)
                <tr>
                    <td>{{ $s->noKartu }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->noSuratKontrol }}</td>
                    <td>{{ $s->jnsPelayanan }}</td>
                    <td>{{ $s->namaJnsKontrol }}</td>
                    <td>{{ $s->tglRencanaKontrol }}</td>
                    <td>{{ $s->tglTerbitKontrol }}</td>
                    <td>{{ $s->noSepAsalKontrol }}</td>
                    <td>{{ $s->namaPoliTujuan }}</td>
                    <td>{{ $s->namaDokter }}</td>
                    <td>{{ $s->terbitSEP }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
     $("#tbsrk").DataTable({
         "responsive": true,
         "lengthChange": false,
         "autoWidth": true,
         "pageLength": 3,
         "searching": true,
         "order": [
             [7, "desc"]
         ]
     })
 });
 </script>
