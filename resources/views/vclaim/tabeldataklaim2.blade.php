<table id="kunjunganpasienrawatjalan" class="table table-bordered table-hover mt-3">
    <thead>
        <th>Tanggal Kunjungan</th>
        <th>Tanggal Sep</th>
        <th>No Sep</th>
        <th>Nama Pasien</th>
        <th>Nama Dokter</th>
        <th>Unit Kunjungan</th>
        <th>Unit Sep</th>
        <th>Diagnosa</th>
        <th>Biaya</th>
        <th>Biaya disetujui</th>
        <th>Biaya tarif rs</th>
        <th>Status</th>
    <tbody>
        <?php
        function rupiah($angka)
        {
            $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
            return $hasil_rupiah;
        }
        ?>
        @foreach ($datajoin as $d )
            <tr>
                <td>{{ $d['tgl_kunjungan']}}</td>
                <td>{{ $d['tgl_sep']}}</td>
                <td>{{ $d['sep']}}</td>
                <td>{{ $d['nama']}}</td>
                <td>{{ $d['nama_dokter']}}</td>
                <td>{{ $d['unit']}}</td>
                <td>{{ $d['poli_sep']}}</td>
                <td>{{ $d['nama_diag']}}</td>
                <td>{{ rupiah($d['biaya'])}}</td>
                <td>{{ rupiah($d['biaya_acc'])}}</td>
                <td>{{ rupiah($d['biaya_trf_rs'])}}</td>
                <td>{{ $d['status']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#kunjunganpasienrawatjalan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 10,
            "searching": true,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)')
    });
