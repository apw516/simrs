<style>
    .modal-lg {
        max-width: 80% !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hasil Pemeriksaan Laboraotrium</div>
                <div class="card-body">
                    @foreach ($hasil_lab as $c)
                        <iframe src="//192.168.2.74/smartlab_waled/his/his_report?hisno={{ $c->kode_layanan_header }}"
                            width="100%" height="1000px"></iframe>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
