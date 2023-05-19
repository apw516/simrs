@foreach ($cek as $c )
<div class="card">
    <div class="card-header"></div>
    <div class="card-body">
        <iframe src ="{{ $c->fileurl }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach


