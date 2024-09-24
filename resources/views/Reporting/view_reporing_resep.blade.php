@foreach ($header as $h )
<div class="card">
    <div class="card-header">
        Tanggal Resep : {{  $h->tgl_entry }}
        <p class="float-right">Dokter Pengirim : {{ $h->nama_dokter }} | Unit Pengirim : {{ $h->nama_unit_pengirim }} | Unit Penerima : {{ $h->nama_unit }}</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Resep yang diorder</div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>Nama Obat</th>
                                <th>Qty</th>
                                <th>Aturan Pakai</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Resep yang dilayani</div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>Nama Obat</th>
                                <th>Qty</th>
                                <th>Aturan Pakai</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
