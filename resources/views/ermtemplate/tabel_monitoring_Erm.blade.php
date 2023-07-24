<table id="tb_m_erm" class="table table-sm">
    <thead>
        <th>Tgl Masuk</th>
        <th>No RM</th>
        <th>Nama</th>
        <th>Asal Poli</th>
        <th>Perawat</th>
        <th>Dokter</th>
        <th>Status</th>
    </thead>
    <tbody>
        @foreach ($dataerm as $D)
            <tr>
                <td>{{ $D->tgl_masuk }}</td>
                <td>{{ $D->no_rm }}</td>
                <td>{{ $D->nama_pasien }}</td>
                <td>{{ $D->nama_unit }}</td>
                <td>{{ $D->namapemeriksa }}</td>
                <td>{{ $D->nama_dokter }}</td>
                <td>
                    @if ($D->id_asskep == null && $D->id_assdok == null)
                        <button class="badge badge-danger"><i class="bi bi-x-octagon"></i></button>
                    @elseif ($D->id_asskep == null || $D->id_assdok == null)
                        <button class="badge badge-warning"><i class="bi bi-check"></i></button>
                    @else
                    <button class="badge badge-success"><i class="bi bi-check-all"></i></button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tb_m_erm").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
</script>
