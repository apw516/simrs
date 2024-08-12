<table id="tabelriwayattindakanpoli" class="table table-sm table-bordered">
    <thead>
        <th>Nama Tarif</th>
        <th>Jumlah</th>
        <th>Tarif</th>
    </thead>
    <tbody>
        @foreach ($datatarif as $d )
            <tr>
                <td>{{ $d->NAMA_TARIF}}</td>
                <td>{{ $d->jumlah_layanan}}</td>
                <td>Rp. {{ number_format($d->grantotal_layanan, 2, ",", ".")}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
     $(function() {
        $("#tabelriwayattindakanpoli").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
    })
</script>
