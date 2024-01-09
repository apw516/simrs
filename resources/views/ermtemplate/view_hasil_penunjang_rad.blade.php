<style>
    .modal-lg {
        max-width: 95% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Radiologi</div>
                <div class="card-body">
                    <iframe src ="http://192.168.10.17/ZFP?mode=proxy&lights=on&titlebar=on#View&ris_pat_id={{ $rm }}&un=radiologi&pw=YnanEegSoQr0lxvKr59DTyTO44qTbzbn9koNCrajqCRwHCVhfQAddGf%2f4PNjqOaV" width="100%" height="600px"></iframe>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Hasil Expertise</div>
                <div class="card-body">
                    @foreach ($hasil_rad as $r )
                    <iframe src ="http://192.168.2.233/expertise/cetak.php?IDs={{ $r->id_header }}&IDd={{ $r->id_detail }}&tgl_cetak={{ $date }}" width="100%" height="600px"></iframe>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
