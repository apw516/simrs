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
    <button idheader="{{ $idheader }}" type="button" class="btn btn-info cetaketiket"><i class="bi bi-printer"> Etiket </i></button>
    <button idheader="{{ $idheader }}" kode_kunjungan="{{ $datalayanan[0]->kode_kunjungan }}" kodeheader="{{ $datalayanan[0]->kode_layanan_header }}" type="button" class="btn btn-info cetaknota"><i class="bi bi-printer"> Nota </i></button>
    <button type="button" class="btn btn-danger"><i class="bi bi-recycle"> Retur </i></button>
</div>
<script>
     $(".cetaketiket").on('click', function(event) {
        idheader = $(this).attr('idheader')
        window.open('cetaketiket_2/' + idheader);
    });
     $(".cetaknota").on('click', function(event) {
        idheader = $(this).attr('idheader')
        kodekunjungan = $(this).attr('kode_kunjungan')
        kodeheader = $(this).attr('kodeheader')
        window.open('cetaknotafarmasi_2/' + kodekunjungan +'/'+ kodeheader+'/'+idheader);
    });
</script>