@foreach ($cek as $c )
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<div class="card">
    <div class="card-header">{{ $c->kode_header }} {{ $c->acc_number }}</div>
    <div class="card-body">
        <iframe src ="http://192.168.10.17/ZFP?mode=proxy&lights=on&titlebar=on#View&ris_exam_id={{ $c->acc_number }}&un=radiologi&pw=YnanEegSoQr0lxvKr59DTyTO44qTbzbn9koNCrajqCRwHCVhfQAddGf%2f4PNjqOaV" width="1000px" height="600px"></iframe>
        <iframe src ="https://192.168.2.233/expertise/cetak0.php?IDs={{ $c->id_header}}&IDd={{ $c->id_detail }}&tgl_cetak={{ $c->tanggalnya }}" width="1000px" height="600px"></iframe>
    </div>
</div>
@endforeach
