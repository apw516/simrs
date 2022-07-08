<table id="tabelsuratkontrol_peserta" class="table table-sm table-bordered table-hover text-mf">
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
            <tr class="pilihdokter" tgl="{{ $p->tglRencanaKontrol }}"nomorsurat="{{ $p->noSuratKontrol }}" namadokter="{{ $p->namaDokter }}" kodedokter="{{ $p->kodeDokter }}" jnskontrol="{{ $p->jnsKontrol }}" data-dismiss="modal">
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
        tgl = $(this).attr('tgl')
        kode = $(this).attr('kodedokter')
        jns = $(this).attr('jnskontrol')
        $('#suratkontrol').val(nomor)
        $('#nomorspri').val(nomor)
        $('#tglspri').val(tgl)
        $('#namadpjp').val(nama)
        $('#dpjp').val(nama)
        $('#kodedpjp').val(kode)
        if(jns == '2'){
            $('#namadokterlayan').val(nama)
            $('#kodedokterlayan').val(kode)
        }
    });
</script>
