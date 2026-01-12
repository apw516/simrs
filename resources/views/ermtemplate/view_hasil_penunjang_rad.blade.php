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
                @foreach ($DATA as $T )
                    <iframe src ="{{ $T->PUBLICURL}}" width="100%" height="600px"></iframe>
                    <div class="card">
                        <div class="card-header">Expertisi</div>
                        <div class="card-body">
                        <iframe src ="http://196.196.196.251/SIRAMAH/cetakexp/{{ $T->ACCESSIONNUMBER}}" width="100%" height="600px"></iframe>
                        </div>
                    </div>
                    @endforeach
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
