<div class="card">
    <div class="card-header bg-info">Catatan Medis Pasien</div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            @foreach ($kunjungan as $k )
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left text-dark text-bold" type="button" data-toggle="collapse" data-target="#collapse{{ $k->counter }}" aria-expanded="true" aria-controls="collapseOne">
                    Kunjungan Ke - {{ $k->counter }} | {{ $k->nama_unit }} <p class="float-right">{{ $k->tgl_masuk }}</p>
                  </button>
                </h2>
              </div>

              <div id="collapse{{ $k->counter }}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">

                </div>
              </div>
            </div>
            @endforeach
          </div>
    </div>
</div>
