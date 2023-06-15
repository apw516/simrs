@foreach ($cek as $c )
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    <div class="card-header">{{ $c->nama }}</div>
    <div class="card-body">
        <iframe src ="{{ $url }}/{{ $c->gambar}}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach

