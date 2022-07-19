<div class="container">
    <div class="row mt-2">
        <div class="col-md-6">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nomor Rujukan</b> 
                    <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $rujukan->response->rujukan->noKunjungan }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Tanggal Rujukan</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->tglKunjungan }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Poli Tujuan</b> 
                    <a class="float-right text-dark text-monospace d-block p-2 bg-warning text-white">{{ $rujukan->response->rujukan->poliRujukan->nama }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Faskes Perujuk</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->provPerujuk->nama }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Diagnosa</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->diagnosa->nama }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Keluhan</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->keluhan }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Rawat</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->pelayanan->nama }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Nomor Kartu</b> 
                    <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $rujukan->response->rujukan->peserta->noKartu }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Nomor KTP</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->peserta->nik }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Nomor RM</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->peserta->mr->noMR }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Nama Peserta</b> 
                    <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $rujukan->response->rujukan->peserta->nama }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>No.Telp</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->peserta->mr->noTelepon }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Peserta</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->peserta->jenisPeserta->keterangan }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Hak kelas</b> 
                    <a class="float-right text-dark text-monospace">{{ $rujukan->response->rujukan->peserta->hakKelas->keterangan }}
                    </a>
                </li>
                <li class="list-group-item">
                  <b>Status</b> 
                    <a class="float-right text-dark text-monospace d-block p-2 bg-warning text-white">{{ $rujukan->response->rujukan->peserta->statusPeserta->keterangan }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>