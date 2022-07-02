<!-- Profile Image -->
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        <img class="profile-user-img img-fluid img-circle"
             src="{{ asset('public/img/logouser.png') }}"
             alt="User profile picture">
      </div>

      <h3 class="profile-username text-center">{{ $data_peserta->response->peserta->nama}}</h3>

      <p class="text-dark text-center">{{ $data_peserta->response->peserta->jenisPeserta->keterangan }} | <a class="@if($data_peserta->response->peserta->statusPeserta->keterangan == "AKTIF") bg-success @else bg-warning @endif" class="badge">{{ $data_peserta->response->peserta->statusPeserta->keterangan }}
      </a></p>
      <div class="row justify-content-center">
        <div class="col-md-12">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nomor RM</b> <a class="float-right text-dark text-bold">{{ $data_peserta->response->peserta->mr->noMR }}</a>
                </li>
                <li class="list-group-item">
                  <b>Nomor Kartu</b> <a class="float-right text-dark text-bold">{{ $data_peserta->response->peserta->noKartu }}</a>
                </li>
                <li class="list-group-item">
                  <b>Nomor KTP</b> <a class="float-right text-dark text-bold">{{ $data_peserta->response->peserta->nik }}</a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Lahir</b> <a class="float-right text-dark">{{ $data_peserta->response->peserta->tglLahir }}</a>
                </li>
                <li class="list-group-item">
                  <b>Umur</b> <a class="float-right text-dark"> {{ $data_peserta->response->peserta->umur->umurSekarang }}</a>
                </li>
                <li class="list-group-item">
                  <b>Faskes 1</b> <a class="float-right text-dark text-bold">{{ $data_peserta->response->peserta->provUmum->nmProvider }}</a>
                </li>
                <li class="list-group-item">
                  <b>Status | Tanggal Cetak Kartu </b> <a class="float-right text-dark text-bold">{{ $data_peserta->response->peserta->statusPeserta->keterangan }} | {{ $data_peserta->response->peserta->tglCetakKartu }}</a>
                </li>
              </ul>
        </div>
      </div>    

    </div>
    <!-- /.card-body -->
</div>
</div>
</div>