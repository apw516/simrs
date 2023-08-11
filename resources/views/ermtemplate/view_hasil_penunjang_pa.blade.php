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
                    <iframe src ="http://192.168.2.212/simrswaled/SimrsPrint/printEX/{{ $p->id_detail }}" width="100%" height="600px"></iframe>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
