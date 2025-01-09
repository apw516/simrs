@if(count($headerorder) > 0)
<div class="card">
    <div class="card-header">Data Order Radiologi</div>
    <div class="card-body">
        <table id="tabelorderrad" class="table table-sm table-bordered">
            <thead>
                <th>Nama Pemeriksaan</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach ($headerorder as $d )
                    <tr>
                        <td>{{ $d->kode_tarif_detail}}</td>
                        <td>@if($d->status_order == 0) Belum dikirim @elseif($d->status_order == 1) Terkirim @elseif($d->status_order == 2) Sudah dilayani @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
<script>
    $(function() {
        $("#tabelorderrad").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
