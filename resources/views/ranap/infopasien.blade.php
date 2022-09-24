<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">{{ $datapasien[0]->nama_px }}</h3>

                    <p class="text-muted text-center">{{ $datapasien[0]->no_rm }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>NIK</b> <a class="float-right">{{ $datapasien[0]->nik_bpjs }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>No BPJS</b> <a class="float-right">{{ $datapasien[0]->no_Bpjs }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Tgl Lahir</b> <a class="float-right">{{ $datapasien[0]->tgl_lahir }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Alamat</b><br> {{ $datapasien[0]->alamat }}
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Surat Kontrol</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <input hidden type="text" id="nokapeserta" value="{{ $datapasien[0]->no_Bpjs }}">
                    <div class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <select class="form-control" id="bulansurkon">
                                <option>-- Silahkan Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option valie="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>

                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <select class="form-control" id="tahunsurkon">
                                <option>-- Silahkan Pilih Tahun --</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>
                        <button type="" @if ($datapasien[0]->no_Bpjs == '') disabled @endif
                            class="btn btn-primary mb-2" onclick="carisurkonpeserta()">Cari</button>
                    </div>
                    <div class="vriwayatsurkon">
                        @if ($datapasien[0]->no_Bpjs == '')
                            <p class="text-danger"> Pasien tidak memiliki nomor Bpjs </p>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card card-primary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Kunjungan</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                class="fas fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @foreach ($periode as $p)
                        <div class="card card-light collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $p->tgl_masuk }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body scroll2">
                                <H5 class="text-bold text-danger">Riwayat Pelayanan / Tindakan Medis</H5>
                                <table id="tabelriwayatkunjungan" class="table table-sm table-bordered" style="font-size: 12px">
                                    <thead>
                                        <th>TGL MASUK</th>
                                        <th>TGL KELUAR</th>
                                        {{-- <th>COUNTER</th> --}}
                                        <th>NAMA PASIEN</th>
                                        <th>NAMA TARIF</th>
                                        <th>PENJAMIN</th>
                                        <th>PELAYANAN</th>
                                        <th>UNIT</th>
                                        <th>DOKTER</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($kunjungan as $r)
                                            @if ($p->tgl_masuk == $r->TGL_MASUK)
                                                <tr>
                                                    <td>{{ $r->TGL_MASUK }}</td>
                                                    <td>{{ $r->TGL_KELUAR }}</td>
                                                    {{-- <td>{{ $r->KONTER }}</td> --}}
                                                    <td>{{ $r->NAMA_PX }}</td>
                                                    <td>{{ $r->NAMA_TARIF }}</td>
                                                    <td>{{ $r->PENJAMIN }}</td>
                                                    <td>{{ $r->SEQ_1 }}</td>
                                                    <td>{{ $r->NAMA_UNIT }}</td>
                                                    <td>{{ $r->NAMA_PARAMEDIS }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endforeach
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
            $("#tabelriwayatkunjungan").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "responsive" :false,
                "searching": true,
                "order": [
                    [2, "desc"]
                ]
            })
        });
    function carisurkonpeserta() {
        spinner = $('#loader')
        spinner.show()
        bulan = $('#bulansurkon').val()
        tahun = $('#tahunsurkon').val()
        nobpjs = $('#nokapeserta').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                bulan,
                tahun,
                nobpjs,
            },
            url: '<?= route('carisurkonranap') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.vriwayatsurkon').html(response)
            }
        });
    }
</script>
