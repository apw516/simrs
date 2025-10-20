<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Obat yang diorder</div>
            <div class="card-body">
                <table class="table table-sm table-bordered text-xs">
                    <thead>
                        <th>Nama Obat</th>
                        <th>Dosis</th>
                        <th>Sediaan</th>
                        <th>Jumlah</th>
                        <th>Keterangan | Aturan Pakai</th>
                    </thead>
                    <tbody>
                        @foreach ($arrayobatorder as $dd)
                            @foreach ($dd as $d)
                            <tr>
                                <td>{{ $d->namabarang}}</td>
                                <td>{{ $d->dosis}}</td>
                                <td>{{ $d->sediaan}}</td>
                                <td>{{ $d->jumlah}}</td>
                                <td>{{ $d->jenisresep}} | {{ $d->aturanpakai}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Obat yang dilayani</div>
            <div class="card-body">
<table class="table table-sm table-bordered text-xs">
                    <thead>
                        <th>Nama Obat</th>
                        <th>Dosis</th>
                        <th>Sediaan</th>
                        <th>Jumlah</th>
                        <th>Keterangan | Aturan Pakai</th>
                    </thead>
                    <tbody>
                        @foreach ($arrayobatfix as $dd)
                            @foreach ($dd as $d)
                            <tr>
                                <td>{{ $d->nama_barang}}</td>
                                <td>{{ $d->dosis}}</td>
                                <td>{{ $d->sediaan}}</td>
                                <td>{{ $d->jumlah_layanan}}</td>
                                <td>{{ $d->aturan_pakai}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button class="btn btn-success cetaketiket" idheader="{{ $arrayobatfix[0][0]->idheader }}"><i class="bi bi-list-check mr-1 ml-1"></i> Cetak Etiket</button>
                <button class="btn btn-success cetaknota" idheader="{{ $arrayobatfix[0][0]->idheader }}" kode_kunjungan="{{ $arrayobatfix[0][0]->kode_kunjungan }}" kodeheader="{{ $arrayobatfix[0][0]->kode_layanan_header }}"><i class="bi bi-list-check mr-1 ml-1"></i> Cetak Nota</button>
                <button class="btn btn-success" idheader="{{ $idorder }}"><i class="bi bi-list-check mr-1 ml-1"></i> Selesai</button>
            </div>
        </div>
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