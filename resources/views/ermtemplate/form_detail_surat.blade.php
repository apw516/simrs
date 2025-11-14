<table class="table table-sm">
    <tr>
        <td>Unit Tujuan</td>
        <td>: {{ $cek[0]->namaunittujuan}}</td>
    </tr>
    <tr>
        <td>Diagnosa</td>
        <td>: {{ $cek[0]->keterangan_klinis}}</td>
    </tr>
    <tr>
        <td>Keterangan</td>
        <td>: {{ $cek[0]->keterangan}}</td>
    </tr>
    <tr>
        <td>jenis</td>
        <td>: {{ $cek[0]->jenis_surat}}</td>
    </tr>
</table>

<button class="btn btn-success cetakdokumen" iddokumen="{{ $cek[0]->id}}"><i class="bi bi-printer"></i> Cetak surat</button>                          
<script>
     $(".cetakdokumen").on('click', function(event) {
        iddokumen = $(this).attr('iddokumen')
        window.open('cetaksuratpengantar/' + iddokumen)
    });
</script>