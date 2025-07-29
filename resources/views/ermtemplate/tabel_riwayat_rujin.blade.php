<div class="card">
    <div class="card-header">Surat Rujuk Internal atau Konsul Antar Poli</div>
    <div class="card-body">
        <table class="table table-sm table-bordered table-hover">
            <thead>
                <th>Unit Tujuan</th>
                <th>Tanggal Konsul</th>
                <th>Jenis</th>
                <th>Catatan</th>
                <th>-</th>
            </thead>
            <tbody>
                @foreach ($datakonsul as $d)
                    <tr>
                        <td>{{ $d->poli_konsul }}</td>
                        <td>{{ $d->tgl_konsul }}</td>
                        <td>{{ $d->jenis }}</td>
                        <td>{{ $d->catatan }}</td>
                        <td>
                            <button class="btn btn-info cetaksuratrujin">Cetak</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
