@foreach ($cek as $c )
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    <div class="card-header">{{ $c->kode_header }}</div>
    <div class="card-body">
        <iframe src ="https://192.168.2.233/expertise/cetak0.php?IDs={{ $c->id_header}}&IDd={{ $c->id_detail }}&tgl_cetak={{ $c->tanggalnya }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach
