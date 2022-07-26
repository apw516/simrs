<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nomor Rujukan</b>
                            <div class="bataledit">
                                <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $data->response->rujukan->noRujukan }}
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>Nomor SEP</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->noSep }}</a>
                        </li>                        
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Tgl Rujukan</b>
                            <div class="bataledit">
                                <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $data->response->rujukan->tglRujukan }}
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl SEP</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->tglSep }}</a>
                        </li>                        
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>PPK diRujukan</b>
                            <div class="bataledit">
                                <a class="float-right text-dark text-monospace d-block p-2 bg-info text-white">{{ $data->response->rujukan->namaPpkDirujuk }}
                                </a>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl rencana kunjungan</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->tglRencanaKunjungan }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <input hidden type="text" id="nomorrujukanprint" value="{{ $data->response->rujukan->noRujukan }}">
                            <a class="float-right text-dark text-bold text-monospace" nomor="" onclick="printrujukan()"><i class="bi bi-printer"></i> Print</a>
                        </li>                        
                    </ul>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Nomor Kartu</b>
                                <a class="float-right text-dark text-monospace">{{ $data->response->rujukan->noRujukan }}
                                </a>
                        </li>
                        <li class="list-group-item">
                            <b>Nama</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->nama }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Tgl lahir</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->tglLahir }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Jenis Kelamin</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->kelamin }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Kelas Rawat</b> <a
                                class="float-right text-dark text-bold text-monospace">Kelas {{ $data->response->rujukan->kelasRawat }}</a>
                        </li>                        
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Diagnosa rujukan</b>
                                <a class="float-right text-dark text-monospace">{{ $data->response->rujukan->namaDiagRujukan }}
                                </a>
                        </li>
                        <li class="list-group-item">
                            <b>Tipe rujukan</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->namaTipeRujukan }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Poli Rujukan</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->namaPoliRujukan }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Jenis Pelayanan</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->jnsPelayanan }}</a>
                        </li>                        
                        <li class="list-group-item">
                            <b>Catatan</b> <a
                                class="float-right text-dark text-bold text-monospace">{{ $data->response->rujukan->catatan }}</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function printrujukan()
    {
        data = $('#nomorrujukanprint').val()
        window.open('cetakrujukan/' + data);
    }
</script>