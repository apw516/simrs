<table class="table table-sm table-bordered">
    <thead>
        <th>Nama</th>
        <th>Jumlah</th>
        <th>Tarif</th>
        <th>Subtotal</th>
    </thead>
    <tbody>
        @foreach ($datalayanan as $d)
            <tr>
                <td>{{ $d->nama_barang }} {{ $d->NAMA_TARIF }} {{ $d->nama_racik}}</td>
                <td>{{ $d->jumlah_layanan }}</td>
                <td>Rp. {{ number_format($d->total_tarif, 2) }}
                </td>
                <td> Rp. {{ number_format($d->total_layanan, 2) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="3" class="text-center text-bold">Grandtotal</td>
            <td>Rp. {{ number_format($d->grandtotal, 2) }}
            </td>
        </tr>
    </tbody>
</table>
<div class="btn-group mr-2" role="group" aria-label="First group">
    <button type="button" class="btn btn-info"><i class="bi bi-printer"> Etiket </i></button>
    <button type="button" class="btn btn-info"><i class="bi bi-printer"> Nota </i></button>
    <button type="button" class="btn btn-danger"><i class="bi bi-recycle"> Retur </i></button>
</div>
