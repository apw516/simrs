@foreach ($dataheader as $d )
    <div class="card">
        <div class="card-header">KODE LAYANAN HEADER : {{ $d->kode_layanan_header }} | {{ $d->nama_penjamin }}<br>
            UNIT PENERIMA : {{ $d->nama_unit}}<br>
            DOKTER PENGIRIM : {{ $d->nama_dokter}}<br>
            UNIT PENGIRIM : {{ $d->unit_pengirim}}
            <br>
            <button class="btn btn-primary btn-sm mt-3 cetaknota" idheader="{{ $d->id }}" kodekunjungan="{{ $d->kode_kunjungan}}" kodeheader="{{ $d->kode_layanan_header}}"><i class="bi bi-printer mr-1"></i>Nota</button>
            <button class="btn btn-primary btn-sm mt-3 cetaketiket" idheader="{{ $d->id }}"><i class="bi bi-printer mr-1"></i>Etiket</button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-hover">
                <thead class="bg-light">
                    <th>Nama Barang</th>
                    <th>Tipe Anestesi</th>
                    <th>Satuan</th>
                    <th>Aturan Pakai</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </thead>
                <tbody>
                    @foreach ($datalayanan as $dl)
                        @if($dl->idheader == $d->id)
                            <tr>
                                <td>{{ $dl->nama_barang }} {{ $dl->NAMA_TARIF }} {{ $dl->nama_racik }} </td>
                                <td>@if($dl->kdbrg != '') @if($dl->tipe_anestesi == 80) REGULER @elseif($dl->tipe_anestesi == 81) KRONIS @endif @endif</td>
                                <td>{{ $dl->satuan }}</td>
                                <td>{{ $dl->aturan_pakai }}</td>
                                <td>{{ $dl->jumlah_layanan }}</td>
                                <td>Rp. {{ number_format($dl->total_tarif, 2) }} </td>
                                <td>Rp. {{ number_format($dl->grantotal_layanan, 2) }} </td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td class="text-bold text-center bg-light" colspan="6">Grand Total</td>
                                <td class="text-bold bg-light" >
                                    Rp. {{ number_format($d->total_layanan, 2) }}
                                </td>
                            </tr>
                </tbody>
            </table>
        </div>
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
@endforeach
