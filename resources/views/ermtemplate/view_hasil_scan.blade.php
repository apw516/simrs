@foreach ($cek as $c )
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <iframe src ="{{ $c->fileurl }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach

