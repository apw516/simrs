@foreach ($cek as $c )
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    <div class="card-header bg-light text-bold">@if($c->jenisberkas == 1) Rawat Inap @elseif($c->jenisberkas == 2)Rawat Jalan @else Penunjang @endif</div>
    <div class="card-body">
        <iframe src ="{{ $c->fileurl }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach

