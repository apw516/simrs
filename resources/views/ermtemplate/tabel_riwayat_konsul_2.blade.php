<table id="tabel_riwayat_konsul_2" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Dokter Pengirim</th>
        <th>Poli Asaal</th>
        <th>Dokter Penerima</th>
        <th>Poli Penerima</th>
        <th>Keterangan Konsul</th>
        <th>Jawaban Konsul</th>
        <th>Tanggal Konsul</th>
        <th>Tanggal Jawab</th>
    </thead>
    <tbody>
        @foreach ($data as $d )
            <tr>
                <td>{{ $d->dok_kirim}}</td>
                <td>{{ $d->poli_kirim}}</td>
                <td>{{ $d->dok_terima}}</td>
                <td>{{ $d->poli_terima}}</td>
                <td>{{ $d->catatan}}</td>
                <td>{{ $d->jawaban_konsul}}</td>
                <td>{{ $d->tgl_konsul}}</td>
                <td>{{ $d->tgl_jawab}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
   $(function() {
        $("#tabel_riwayat_konsul_2").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
</script>
