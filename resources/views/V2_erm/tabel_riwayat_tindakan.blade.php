<table class="table table-sm table-bordered table-hover" id="tabel_data_riwayat_tindakan_today">
    <thead>
        <th>Nama Tindakan</th>
        <th>Tarif</th>
        <th>Jumlah</th>
        <th>===</th>
    </thead>
    <tbody>
        @foreach ($riwayat_tindakan as $t )
            <tr>
                <td>{{ $t->NAMA_TARIF}}</td>
                <td>{{ $t->jumlah_layanan}}</td>
                <td>{{ $t->total_tarif}}</td>
                <td><button type="button" class="btn btn-danger btn-sm"> <i
                            class="bi bi-trash mr-1"></i> Batal</button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabel_data_riwayat_tindakan_today").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true
        })
    });
