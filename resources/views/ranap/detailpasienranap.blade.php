<button class="btn btn-warning btn-lg shadow p-3 mb-5 rounded" onclick="baktoindex()"><i
        class="bi bi-backspace-fill mr-2 ml-1"></i>Kembali</button>
<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img width="50%" class="profile-user-img img-fluid img-circle"
                        src="{{ asset('public/img/user.jpg') }}" alt="User profile picture">
                </div>
                <h3 class="profile-username text-center text-bold bg-warning">{{ $mt_pasien[0]->nama_px }}</h3>
                <p class="text-bold text-center"><a href="" class="bg-warning">BPJS : {{ $nomorbpjs }}</a> |
                    RM : {{ $rm }}</p>
                <ul class="list-group list-group-unbordered mb-3 text-xs">
                    <li class="list-group-item">
                        <b>Tanggal lahir</b> <a class="float-right text-dark">{{ $mt_pasien[0]->tgl_lahir }} |
                            {{ $mt_pasien[0]->jenis_kelamin }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <a class="float-right text-dark">{{ $mt_pasien[0]->alamatpasien }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Faskes 1</b> <a
                            class="float-right text-dark">{{ $data_peserta->response->peserta->provUmum->nmProvider }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis BPJS</b> <a
                            class="float-right text-dark">{{ $data_peserta->response->peserta->jenisPeserta->keterangan }}</a>
                    </li>
                    <li class="list-group-item bg-warning">
                        <b>Status BPJS</b> <a
                            class="float-right text-dark">{{ $data_peserta->response->peserta->statusPeserta->keterangan }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Data sep yang
                                    dipulangkan ...</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('public/img/logobpjs.png') }}" alt="user image">
                                        <span class="username">
                                            <a href="#"
                                                class="text-bold text-dark">{{ $sep->response->noSep }}</a>
                                            {{-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> --}}
                                        </span>
                                        <span class="description">{{ $sep->response->jnsPelayanan }} | Tanggal SEP
                                            {{ $sep->response->tglSep }}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <table class="table table-sm text-dark text-xs">
                                                <tr class="bg-warning">
                                                    <td class="text-bold">Nomor Kartu </td>
                                                    <td class="text-bold">{{ $sep->response->peserta->noKartu }}</td>
                                                </tr>
                                                <tr class="bg-warning">
                                                    <td class="text-bold">Nama Pasien</td>
                                                    <td class="text-bold">{{ $sep->response->peserta->nama }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tgl Pelayanan</td>
                                                    <td>{{ $sep->response->tglSep }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Pelayanan</td>
                                                    <td>{{ $sep->response->jnsPelayanan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Diagnosa</td>
                                                    <td>{{ $sep->response->diagnosa }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-8">
                                            <table class="table table-sm text-dark text-md">
                                                @if ($status_1 == 'false')
                                                    <tr>
                                                        <td><i class="bi bi-x-circle-fill text-danger mr-2"></i>Data
                                                            Tidak
                                                            Sesuai, Nomor kartu pasien tidak sesuai dengan nomor kartu
                                                            di SEP !
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($status_2 == 'false')
                                                    <tr>
                                                        <td><i class="bi bi-x-circle-fill text-danger mr-2"></i>Data
                                                            Tidak
                                                            Sesuai, Jenis SEP Rawat Jalan !</td>
                                                    </tr>
                                                @endif
                                                @if ($status_1 == 'true' && $status_2 == 'true')
                                                    <tr>
                                                        <td class=""><i
                                                                class="bi bi-check2-all mr-1 text-success text-bold"></i><a
                                                                class="text-bold text-dark">Data Sesuai ! SEP bisa
                                                                dipulangkan
                                                                ... ( Alasan : {{ $alasanpulang }} )</a><br>
                                                            <p class="font-italic">keterangan : {{ $keterangan }}</p>
                                                            <button class="btn btn-success mt-1 pulangkansep"
                                                                rm="{{ $rm }}"
                                                                kodekunjungan="{{ $kodekunjungan }}"
                                                                tglpulang="{{ $tglpulang }}"
                                                                alasan="{{ $alasan }}"
                                                                nomorsep="{{ $sep->response->noSep }}"
                                                                nama="{{ $mt_pasien[0]->nama_px }}"><i
                                                                    class="bi bi-pencil-square mr-1 ml-1"></i>Pulangkan
                                                                SEP</button>
                                                            <button class="btn btn-info mt-1 buatsurkon"
                                                                nomorsep="{{ $sep->response->noSep }}"><i
                                                                    class="bi bi-pencil-square mr-1 ml-1"></i>Buat Surat
                                                                Kontrol</button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Riwayat Surat Kontrol</div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputState">Pilih Bulan</label>
                                    <select id="bulanpencarian" class="form-control">
                                        <option selected>Silahkan Pilih</option>
                                        <option value="01" @if ($bulan == '01') selected @endif>Januari
                                        </option>
                                        <option value="02" @if ($bulan == '02') selected @endif>
                                            Februari</option>
                                        <option value="03" @if ($bulan == '03') selected @endif>Maret
                                        </option>
                                        <option value="04" @if ($bulan == '04') selected @endif>April
                                        </option>
                                        <option value="05" @if ($bulan == '05') selected @endif>Mei
                                        </option>
                                        <option value="06" @if ($bulan == '06') selected @endif>Juni
                                        </option>
                                        <option value="07" @if ($bulan == '07') selected @endif>Juli
                                        </option>
                                        <option value="08" @if ($bulan == '08') selected @endif>
                                            Agustus</option>
                                        <option value="09" @if ($bulan == '09') selected @endif>
                                            September</option>
                                        <option value="10" @if ($bulan == '10') selected @endif>
                                            Oktober</option>
                                        <option value="11" @if ($bulan == '11') selected @endif>
                                            November</option>
                                        <option value="12" @if ($bulan == '12') selected @endif>
                                            Desember</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Pilih Tahun</label>
                                    <select id="tahunpencarian" class="form-control">
                                        <option>Silahkan Pilih</option>
                                        <option value="2023" @if ($tahun == '2023') selected @endif>2023
                                        </option>
                                        <option value="2024" @if ($tahun == '2024') selected @endif>2024
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputState">Filter by</label>
                                    <select id="filterpencarian" class="form-control">
                                        <option value="1" selected>Tanggal entri</option>
                                        <option value="2">Tanggal Surat Kontrol</option>
                                    </select>
                                </div>
                                <div class="form-inline col-md-2">
                                    <button type="button" class="btn btn-primary mt-3"
                                        onclick="carisurkon()">Tampilkan</button>
                                </div>
                            </div>
                            <input hidden type="text" id="nokabpjs_ranap" name="nokabpjs_ranap"
                                value="{{ $nomorbpjs }}">
                        </form>
                        <div class="col-md-12">
                            <div class="v_tabel_surkon_2">
                                <table id="tbsrk" class="table table-sm table-bordered text-xs table-hover table-stripped">
                                    <thead>
                                        <th>Nomor Kartu</th>
                                        <th>Nama</th>
                                        <th>Nomor Surat Kontrol</th>
                                        <th>Jenis Pelayanan</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Rencana Kontrol</th>
                                        <th>Tanggal Terbit Surat</th>
                                        <th>SEP asal</th>
                                        <th>Poli Tujuan</th>
                                        <th>Dokter</th>
                                        <th>Terpakai</th>
                                    </thead>
                                    <tbody>
                                        @if ($suratkontrol->metaData->code == 200)
                                            @foreach ($suratkontrol->response->list as $s)
                                                <tr class="detailsurkon">
                                                    <td>{{ $s->noKartu }}</td>
                                                    <td>{{ $s->nama }}</td>
                                                    <td>{{ $s->noSuratKontrol }}</td>
                                                    <td>{{ $s->jnsPelayanan }}</td>
                                                    <td>{{ $s->namaJnsKontrol }}</td>
                                                    <td>{{ $s->tglRencanaKontrol }}</td>
                                                    <td>{{ $s->tglTerbitKontrol }}</td>
                                                    <td>{{ $s->noSepAsalKontrol }}</td>
                                                    <td>{{ $s->namaPoliTujuan }}</td>
                                                    <td>{{ $s->namaDokter }}</td>
                                                    <td>{{ $s->terbitSEP }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
       $(function() {
        $("#tbsrk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [7, "desc"]
            ]
        })
    });
    function baktoindex() {
        location.reload()
    }
    $(".pulangkansep").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        nomorsurat = $(this).attr('nomorsep')
        namapasien = $(this).attr('nama')
        alasan = $(this).attr('alasan')
        tglpulang = $(this).attr('tglpulang')
        rm = $(this).attr('rm')
        if (alasan == 6 || alasan == 7) {
            $("#modalpasienmeninggal").modal();
            $('#alasanmeninggal').val(alasan)
            $('#nomorsep_meninggal').val(nomorsurat)
            $('#tanggal_pulangmeninggal').val(tglpulang)
            $('#kodekunjunganmeninggal').val(kodekunjungan)
            $('#normmeninggal').val(rm)
        } else {
            $("#modalpasienpulang").modal();
            $('#alasanpulang').val(alasan)
            $('#nomorsep_pulang').val(nomorsurat)
            $('#tanggal_pulangpasien').val(tglpulang)
            $('#kodekunjunganpulang').val(kodekunjungan)
            $('#norm').val(rm)
        }
    })
    $(".buatsurkon").on('click', function(event) {
        nomorsep = $(this).attr('nomorsep')
        $('#seppasca').val(nomorsep)
        $("#modalsurkonpasca").modal();
    })

    function carisurkon() {
        bulan = $('#bulanpencarian').val()
        tahun = $('#tahunpencarian').val()
        filter = $('#filterpencarian').val()
        noka = $('#nokabpjs_ranap').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                bulan,
                tahun,
                filter,
                noka
            },
            url: '<?= route('carisuratkontrol_ranap') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.v_tabel_surkon_2').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }
</script>
