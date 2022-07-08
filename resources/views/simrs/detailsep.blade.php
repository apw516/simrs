    <div class="container">
        <div class="row text-md">
            <div class="col-md-2">
                Nomor RM
            </div>
            <div class="col-md-2">
                : {{ $detailsep->response->peserta->noMr }}
            </div>
            <div class="col-md-2">
                Nomor Kartu
            </div>
            <div class="col-md-2">
                : {{ $detailsep->response->peserta->noKartu }}
            </div>
            <div class="col-md-1">
                No SEP
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->noSep }}
            </div>
        </div>
        <div class="row text-md">
            <div class="col-md-2">
                Nomor Rujukan
            </div>
            <div class="col-md-2">
                : {{ $detailsep->response->tglSep }}
            </div>
            <div class="col-md-2">
                Poli Tujuan
            </div>
            <div class="col-md-2">
                : {{ $detailsep->response->poli }}
            </div>
            <div class="col-md-1">
                No.Rujukan
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->noRujukan }}
            </div>
        </div>
        <div class="row text-md mt-3">
            <div class="col-md-2">
                Nama
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->nama }}
            </div>
            <div class="col-md-2">
                Jenis Peserta
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->jnsPeserta }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Tanggal lahir
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->tglLahir }}
            </div>
            <div class="col-md-2">
                Jns Kelamin
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->kelamin }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Hak kelas
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->hakKelas }}
            </div>
            <div class="col-md-2">
                Asuransi
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->peserta->asuransi }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                penjamin
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->penjamin }}
            </div>
            <div class="col-md-2">
                Poli Eksekutif
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->poliEksekutif }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Kelas rawat naik
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->klsRawat->klsRawatNaik }}
            </div>
            <div class="col-md-2">
                Pembiayaan
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->klsRawat->pembiayaan }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Cob
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->cob }}
            </div>
            <div class="col-md-2">
                Katarak
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->katarak }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Status Kecelakaan
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->nmstatusKecelakaan }}
            </div>
            <div class="col-md-2">
                Surat Kontrol
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->kontrol->noSurat }}
            </div>
        </div>
        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Catatan
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->catatan }}
            </div>
        </div>


        <div class="row text-md-mt-2">
            <div class="col-md-2">
                Dokter
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->dpjp->nmDPJP }}
            </div>
            <div class="col-md-2">
                Jns pelayanan
            </div>
            <div class="col-md-3">
                : {{ $detailsep->response->jnsPelayanan }} | {{ $detailsep->response->kelasRawat }}
            </div>
        </div>
        <div class="row text-md mt-3">
            <div class="col-md-2">
                Diagnosa
            </div>
            <div class="col-md-8">
                : {{ $detailsep->response->diagnosa }}
            </div>
        </div>
    </div>
    <div class="container">
        <h4>Data SEP internal</h4>
        <table id="tabelsepinternal" class="table table-sm table-bordered">
            <thead>
                <th>No SEP</th>
                <th>No Surat</th>
                <th>No SEP ref</th>
                <th>tgl sep</th>
                <th>Poli Asal</th>
                <th>Poli rujukan</th>
                <th>Dokter</th>
                <th>Diagnosa</th>
                <th>tgl rujuk internal</th>
                <th>user</th>
            </thead>
            <tbody>
                @if ($sepinternal->metaData->code == 200)
                    @foreach ($sepinternal->response->list as $d)
                        <tr>
                            <td>{{ $d->nosep }}</td>
                            <td>{{ $d->nosurat }}</td>
                            <td>{{ $d->nosepref }}</td>
                            <td>{{ $d->tglsep }}</td>
                            <td>{{ $d->nmpoliasal }}</td>
                            <td>{{ $d->nmtujuanrujuk }}</td>
                            <td>{{ $d->nmdokter }}</td>
                            <td>{{ $d->nmdiag }}</td>
                            <td>{{ $d->tglrujukinternal }}</td>
                            <td>{{ $d->fuser }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
    </div>
    <script>
        $(function() {
            $("#tabelsepinternal").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [2, "desc"]
                ]
            })
        });
    </script>
