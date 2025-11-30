<style>
    .modal-lg {
        max-width: 95% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Expertisi Urologi</div>
                <div class="card-body">
                    @foreach ($hasil_ex as $p )
                    {{-- <iframe src ="http://192.168.2.212/simrswaled/SimrsPrint/printEX/{{ $p->id_detail }}" width="100%" height="600px"></iframe> --}}
                    <div class="card">
                        <div class="card-header bg-info">Tanggal Periksa  {{ $p->tgl_kunjungan }} | {{ $p->nama_dokter }}</div>
                        <div class="card-body">
                            <h5>Hasil Expertisi</h5><br>
                            <p>
                                {{ $p->evaluasi }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
