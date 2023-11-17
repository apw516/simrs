<style>
    .modal-lg {
        max-width: 95% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Laboratorium PA</div>
                <div class="card-body">
                    @foreach ($hasil_pa as $p )
                    {{-- <iframe src ="http://192.168.2.212/simrswaled/SimrsPrint/printEX/{{ $p->id_detail }}" width="100%" height="600px"></iframe> --}}
                    <div class="card">
                        <div class="card-header bg-info"><h4>{{ $p->unit_asal }}</h4>Tanggal Periksa  {{ $p->tgl_input_layanan }} | No Periksa {{ $p->no_periksa }} | Tipe : {{ $p->tipe }}</div>
                        <div class="card-body">
                            <h5>Hasil Pemeriksaan</h5><br>
                            <p>
                                {{ $p->hasil }}
                            </p>

                            <h5>Diagnostik Pasca Bedah</h5><br>
                            <p>
                                {{ $p->diagnostik_pasca_bedah }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
