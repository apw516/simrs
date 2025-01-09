<div class="card">
    <div class="card-header">Data Order Farmasi</div>
    <div class="card-body">
        <table id="tabelorderfarmasi" class="table table-sm table-bordered">
            <thead>
                <th>Nomor Antrian</th>
                <th>Jenis Antrian Antrian</th>
                <th>Nama Obat</th>
                <th>Qty</th>
                <th>Aturan Pakai</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($headerorder as $d )
                    <tr>
                        <td>{{ $d->nomor_antrian}}</td>
                        <td>@if($d->jenis_antrian== 1)Reguler @else Racikan @endif</td>
                        <td>{{ $d->nama_barang}}</td>
                        <td>{{ $d->qty}}</td>
                        <td>{{ $d->aturan_pakai}}</td>
                        <td>@if($d->status_order == 2) Terkirim @elseif($d->status_order == 3) Sudah dilayani @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $(function() {
        $("#tabelorderfarmasi").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
