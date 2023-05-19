@foreach ($cek as $c )
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <iframe src ="//192.168.2.74/smartlab_waled/his/his_report?hisno={{ $c->kode_layanan_header }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach


