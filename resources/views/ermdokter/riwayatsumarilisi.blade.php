<div class="card">
    <div class="card-header bg-info">Riwayat Sumarilis</div>
    <div class="card-body">
        <table id="tabelriwayatsumarilis" class="table table-sm table-bordered table-hover">
            <thead>
                <th>Tanggal</th>
                <th>Diagnosa</th>
                <th>Siklus</th>
                <th>Keterangan</th>
                <th>Obat</th>
            </thead>
            <tbody>
                @foreach ($data as $d )
                    <tr>
                        <td>{{ $d->tgl_kunjungan}}</td>
                        <td>{{ $d->diagnosa}}</td>
                        <td>{{ $d->siklus}}</td>
                        <td>{{ $d->ket_regimen}}</td>
                        <td>{{ $d->obat}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $("#tabelriwayatsumarilis").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": false,
            "order" :[4,'asc']
        })
    });
