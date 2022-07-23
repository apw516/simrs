<div class="container">
    <div class="card">
        <div class="card-header bg-info">Detail PRB</div>
        <div class="card-body">
            @if($list->metaData->code != 200)
            <h5 class="text-danger">Data tidak ditemukan : {{
                    $list->metaData->message
                }} ...
                </h5>
            @else
                {{ $list->response->prb->noSRB }}
            @endif
        </div>
    </div>
</div>