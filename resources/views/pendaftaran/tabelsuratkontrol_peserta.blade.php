<table id="tabelsuratkontrol_peserta" class="table table-sm table-bordered table-hover text-xs">
    <thead>
        <th>Nomor surat</th>
        <th>jns kontrol</th>
        <th>tgl kontrol</th>
        <th>tgl terbit</th>
        <th>Sep asal</th>
        <th>Poli asal</th>
        <th>Poli tujuan</th>
        <th>dokter</th>
        <th>Terbit sep</th>
    </thead>
    <tbody>
        @if($suratkontrol->metaData->code == 200)
        @foreach ($suratkontrol->response->list as $p)
            <tr class="pilihdokter" nomorsurat="{{ $p->noSuratKontrol }}" namadokter="{{ $p->namaDokter }}" kodedokter="{{ $p->kodeDokter }}" data-dismiss="modal">
                <td>{{ $p->noSuratKontrol }}</td>
                <td>{{ $p->namaJnsKontrol }}</td>
                <td>{{ $p->tglRencanaKontrol }}</td>
                <td>{{ $p->tglTerbitKontrol }}</td>
                <td>{{ $p->noSepAsalKontrol }}</td>
                <td>{{ $p->namaPoliAsal }}</td>
                <td>{{ $p->namaPoliTujuan }}</td>
                <td>{{ $p->namaDokter }}</td>
                <td>{{ $p->terbitSEP }}</td>
            </tr>
        @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelsuratkontrol_peserta").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [[ 2, "desc" ]]
        })
    });
    $('#tabelsuratkontrol_peserta').on('click', '.pilihdokter', function() {
        nomor = $(this).attr('nomorsurat')
        nama = $(this).attr('namadokter')
        kode = $(this).attr('kodedokter')
        $('#suratkontrol').val(nomor)
        $('#namadpjp').val(nama)
        $('#kodedpjp').val(kode)
        $('#namadokterlayan').val(nama)
        $('#kodedokterlayan').val(kode)
    });
</script>
