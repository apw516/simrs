<div class="container mt-3">
    <div class="card card-outline card-success">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header bg-info">Riwayat Kunjungan</div>
                <div class="card-body">
                <button class="btn btn-danger"  data-toggle="modal"
                data-target="#modalriwayatsep"><i class="bi bi-search"></i> Riwayat SEP Terakhir</button>
                    <table id="tabelriwayatkunjungan" class="table table-bordered table-sm text-xs">
                        <thead>
                            <th>Unit</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>PENJAMIN</th>
                            <th>Catatan</th>
                            <th>Dokter</th>
                            <th>SEP</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_kunjungan as $r)
                                <tr>
                                    <td>{{ $r->nama_unit }}</td>
                                    <td>{{ $r->tgl_masuk }}</td>
                                    <td>{{ $r->tgl_keluar }}</td>
                                    <td>{{ $r->nama_penjamin }}</td>
                                    <td>{{ $r->CATATAN }}</td>
                                    <td>{{ $r->dokter }}</td>
                                    <td>{{ $r->no_sep }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-5">
                <div class="container">
                    <div class="card">
                        <input hidden type="text" value="{{ $cek_kunjungan }}" id="status_kunjungan">
                        {{-- @dd($data_peserta->response->peserta->noKartu); --}}
                        <div class="card-header bg-info">Info Peserta</div>
                        <div class="card-body text-sm">
                            <div class="row">
                                <div class="col-sm-3">Nomor RM</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->mr->noMR }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor Kartu</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->noKartu }}</div>
                                <input hidden type="text" value="{{ $data_peserta->response->peserta->noKartu }}"
                                    id="nomorkartu">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor KTP</div>
                                <div class="col-sm-5">: {{ $data_peserta->response->peserta->nik }}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">Nama</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->nama }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor Telp</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->mr->noTelepon }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Tgl lahir</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->tglLahir }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Status Peserta</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->statusPeserta->keterangan }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Jenis Peserta</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->jenisPeserta->keterangan }}</div>
                                <input hidden type="text"
                                    value="{{ $data_peserta->response->peserta->jenisPeserta->keterangan }}"
                                    id="penjamin">
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Hak Kelas</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->hakKelas->keterangan }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Faskes 1</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->provUmum->nmProvider }}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Umur</div>
                                <div class="col-sm-8">:
                                    {{ $data_peserta->response->peserta->umur->umurSekarang }}</div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">COB</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->cob->nmAsuransi }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">Nomor</div>
                                <div class="col-sm-8">: {{ $data_peserta->response->peserta->cob->noAsuransi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-3">
                <h4 class="text-danger mb-2">*Wajib Diisi</h4>
                @if ($data_peserta->response->peserta->statusPeserta->keterangan != 'AKTIF')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>STATUS PASIEN
                            {{ $data_peserta->response->peserta->statusPeserta->keterangan }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div id="kunjunganrujukan_count"></div>
                <div class="container mt-3">
                    <div class="row justify-content-center">
                        {{-- <div class="col-sm-2 text-right text-bold">
                        </div> --}}
                        <div class="col-sm-10">
                            <button class="btn btn-warning btn-sm mb-3 float-right ml-1" data-toggle="modal"
                                data-target="#staticBackdrop"><i class="bi bi-plus-lg"></i> SPRI / Surat
                                Kontrol</button>
                            <button class="btn btn-info btn-sm mb-3 float-right ml-1" data-toggle="modal"
                                data-target="#modalcarispri" onclick="carisuratkontrol()"><i class="bi bi-search"></i>
                                SPRI / Surat Kontrol</button>
                            <button class="btn btn-success btn-sm mb-3 float-right ml-1" data-toggle="modal"
                                data-target="#modalrujukan" onclick="carirujukan()"><i class="bi bi-search"></i>
                                Rujukan</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-right text-bold">Jenis Pelayanan</div>
                        <div class="col-sm-7">
                            <select class="form-control" id="jenispelayanan" onchange="gantijenispelayanan()">
                                <option value="1">Rawat Inap</option>
                                <option selected value="2">Rawat Jalan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 pilihpoli">
                        <div class="col-sm-4 text-right text-bold">Spesialis / Sub spesialis</div>
                        <div class="col-sm-7">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="mr-1" id="polieksekutif"
                                            value="1">Eksekutif
                                    </div>
                                </div>
                                <input type="text" class="form-control" value="INSTALASI GAWAT DARURAT"
                                    aria-label="Text input with checkbox" id="politujuan">
                            </div>
                            <input hidden type="text" class="form-control" value="IGD"
                                aria-label="Text input with checkbox" id="kodepolitujuan">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">DPJP Yang melayani</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="ketik nama dokter ..."
                                id="namadokterlayan">
                            <input hidden type="text" class="form-control" id="kodedokterlayan">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Asal Rujukan</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="asalrujukan">
                                <option value="1">Faskes 1</option>
                                <option selected value="2">Faskes 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">PPK Asal rujukan</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="namappkrujukan" value="RSUD WALED">
                            <input hidden type="text" class="form-control" id="kodeppkrujukan" value="1018R001">
                        </div>
                    </div>
                    <div hidden id="non-igd">
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Tgl Rujukan</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tglrujukan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Nomor Rujukan</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nomorrujukan">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">No.Surat Kontrol / SPRI</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="suratkontrol">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">DPJP Pemberi Surat Kontrol / SPRI</div>
                            <div class="col-sm-7">
                                <input readonly type="text" class="form-control" id="namadpjp">
                                <input hidden type="text" class="form-control" id="kodedpjp">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Tgl SEP</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tglsep">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">NO.MR</div>
                        <div class="col-sm-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="mr-1" id="cob" value="1">COB
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="norm" value="{{ $nomorrm }}">
                            </div>
                        </div>
                    </div>
                    <div hidden id="formranap">
                        <div class="row">
                            <div class="col-sm-4 text-right text-bold">Kelas Rawat</div>
                            <div class="col-sm-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="mr-1" value="1" id="naikkelas">Naik
                                            kelas
                                        </div>
                                    </div>
                                    <input readonly type="text" class="form-control" id="keteranganhakkelas"
                                        value="{{ $data_peserta->response->peserta->hakKelas->keterangan }}">
                                </div>
                                <input hidden readonly type="text" class="form-control" id="hakkelas"
                                    value="{{ $data_peserta->response->peserta->hakKelas->kode }}">
                            </div>
                        </div>
                        <div hidden id="formnaikkelas" class="card-body bg-secondary">
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    Kelas Rawat Inap
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control form-control-md" id="kelasrawatnaik">
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="1">VVIP</option>
                                        <option value="2">VIP</option>
                                        <option value="3">Kelas 1</option>
                                        <option value="4">Kelas 2</option>
                                        <option value="5">Kelas 3</option>
                                        <option value="6">ICCU</option>
                                        <option value="7">ICU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    Pembiayaan
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control form-control-md" id="pembiayaan">
                                        <option value="">-- Silahkan Pilih --</option>
                                        <option value="1">Pribadi</option>
                                        <option value="2">Pemberi Kerja</option>
                                        <option value="3">Asuransi Kesehatan Tambahan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4 text-right">
                                    Nama Penanggung Jawab
                                </div>
                                <div class="col-md-8">
                                    <textarea class="form-control" placeholder="Jika pembiayaan oleh pemberi kerja atau layanan kesehatan tambahan"
                                        id="penanggugjawab"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-right text-bold">Cek Ruangan</div>
                            <div class="col-sm-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="mr-1" value="1"
                                                id="hakkelaspenuh">Penuh
                                        </div>
                                    </div>
                                    <input disabled readonly type="text" class="form-control"
                                        value="ceklis jika ruangan sesuai hak kelas penuh">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Pilih Unit</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="namaunitranap">
                                    <option value="">-- Silahkan Pilih --</option>
                                    @foreach ($mt_unit as $a)
                                        <option value="{{ $a->kode_unit }}"> {{ $a->nama_unit }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Pilih Kamar</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="kamarranap">
                                    <option value="">-- Silahkan Pilih --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Pilih Bed</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="bedranap">
                                    <option value="">-- Silahkan Pilih --</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Diagnosa</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="namadiagnosa">
                            <input hidden type="text" class="form-control" id="kodediagnosa">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">No.Telepon</div>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="nomortelepon"
                                value="{{ $mt_pasien[0]['no_tlp'] }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Catatan</div>
                        <div class="col-sm-7">
                            <textarea type="text" class="form-control" id="catatan"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Katarak</div>
                        <div class="col-sm-7">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" class="mr-1" id="katarak" value="1">
                                    </div>
                                </div>
                                <input readonly type="text" class="form-control"
                                    value="Centang Katarak , Jika Peserta Tersebut Mendapatkan Surat Perintah Operasi katarak">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 text-right text-bold">Alasan Masuk</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="alasanmasuk">
                                @foreach ($alasan_masuk as $a)
                                    <option value="{{ $a->id }}"
                                        @if ($a->id == 1) selected @endif> {{ $a->alasan_masuk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">Status Kecelakaan</div>
                        <div class="col-sm-7">
                            <select class="form-control form-control-sm" id="keterangan_kll">
                                <option value="">-- Silahkan Pilih --</option>
                                <option value="0">Bukan Kecelakaan lalu lintas [BKLL]</option>
                                <option value="1">KLL dan bukan kecelakaan Kerja [BKK]</option>
                                <option value="2">KLL dan KK</option>
                                <option value="3">Kecelakaan Kerja</option>
                            </select>
                        </div>
                    </div>
                    <div hidden id="formlaka">
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" class="mr-1" id="keterangansuplesi"
                                                value="1">Suplesi
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="sepsuplesi">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Tgl Kejadian</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                    id="tglkejadianlaka">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">No.LP</div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="nomorlp">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Lokasi Kejadian</div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="provinsikejadian">
                                    <option value="">-- Silahkan Pilih Provinsi --</option>
                                    @foreach ($provinsi->response->list as $p)
                                        <option value="{{ $p->kode }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="kabupatenkejadian">
                                    <option value="">-- Silahkan Pilih Kabupaten --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold"></div>
                            <div class="col-sm-7">
                                <select class="form-control form-control-sm" id="kecamatankejadian">
                                    <option value="">-- Silahkan Pilih Kecamatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-right text-bold">Keterangan</div>
                            <div class="col-sm-7">
                                <textarea type="text" class="form-control" id="keteranganlaka"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 text-right text-bold">
                        </div>
                        <div class="col-sm-7">
                            <button @if ($data_peserta->response->peserta->statusPeserta->keterangan != 'AKTIF') disabled @endif
                                class="btn btn-success mt-3 float-right simpanpendaftaran" data-toggle="modal"
                                data-target="#modalasessment">Simpan</button>
                            <button class="btn btn-danger mt-3 float-right mr-2"
                                onclick="location.reload()">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalasessment" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tujuan Kunjungan</label>
                    <select class="form-control" id="tujuankunjungan" onchange="gantitujuan()">
                        <option value="0">Normal</option>
                        <option value="1">Prosedur</option>
                        <option value="2">Konsul Dokter</option>
                    </select>
                </div>
                <div hidden class="form-group fg">
                    <label>Flag Procedure</label>
                    <select class="form-control" id="flagprocedure">
                        <option value="">-- Silahkan Pilih --</option>
                        <option value="0">Prosedur Tidak Berkelanjutan</option>
                        <option value="1">Prosedur dan Terapi Berkelanjutan</option>
                    </select>
                </div>
                <div hidden class="form-group pn">
                    <label>Penunjang</label>
                    <select class="form-control" id="penunjang">
                        <option value="">-- Silahkan Pilih --</option>
                        <option value="1">Radioterapi</option>
                        <option value="2">Kemoterapi</option>
                        <option value="3">Rehabilitasi Medik</option>
                        <option value="4">Rehabilitasi Psikososial</option>
                        <option value="5">Transfusi Darah</option>
                        <option value="6">Pelayanan Gigi</option>
                        <option value="7">Laboratorium</option>
                        <option value="8">USG</option>
                        <option value="9">Farmasi</option>
                        <option value="10">Lain-Lain</option>
                        <option value="11">MRI</option>
                        <option value="12">HEMODIALISA</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>asessment</label>
                    <select class="form-control" id="asessment">
                        <option value=""> - </option>
                        <option value="1">Poli spesialis tidak tersedia pada hari sebelumnya</option>
                        <option value="2">Jam Poli telah berakhir pada hari sebelumnya</option>
                        <option value="3">Dokter Spesialis yang dimaksud tidak praktek pada hari sebelumnya</option>
                        <option value="4">Atas Instruksi RS</option>
                        <option value="5">Tujuan Kontrol</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpansep()">Simpan</button>
            </div>
        </div>
    </div>
</div>

{{-- modal buat spri --}}

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Buat Surat Kontrol / SPRI </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Jenis Surat</label>
                    <select class="form-control" id="jenissurat">
                        <option value="1">SPRI</option>
                        <option value="2">SURAT KONTROL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                    <input type="email" class="form-control datepicker" id="tanggalkontrol"
                        placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nomor Kartu</label>
                    <input type="email" class="form-control" id="nomorkartukontrol"
                        value="{{ $data_peserta->response->peserta->noKartu }}" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Poli Kontrol</label>
                    <div class="input-group mb-3">
                        <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                            id="polikontrol">
                        <input hidden readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                            id="kodepolikontrol">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                data-target="#modalpilihpoli" onclick="caripolikontrol()">Cari Poli</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Dokter</label>
                    <div class="input-group mb-3">
                        <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                            id="dokterkontrol">
                        <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                            id="kodedokterkontrol">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                data-target="#modalpilihdokter" onclick="caridokterkontrol()">Cari Dokter</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="buatsuratkontrol()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpilihpoli" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pilih Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vpolikontrol">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpilihdokter" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pilih Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vdokterkontrol">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalcarispri" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cari SPRI / Surat Kontrol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vspri">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatsep" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Riwayat SEP Terakhir</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="">nomor kartu</label>
                            <input type="text" class="form-control" id="nomorkartu_riwayatsep" value="{{ $data_peserta->response->peserta->noKartu }}" placeholder="masukan nomor kartu ...">
                        </div>
                        <div class="col-sm-3">
                            <label for="">tanggal awal</label>
                            <?php $tglawal = date('Y-m-d', strtotime('-29 days')) ;?>
                            <input type="text" class="form-control"
                                id="tanggalawal_riwayat" value="{{ $tglawal }}" placeholder="Tanggal awal ..">
                        </div>
                        <div class="col-sm-3">
                            <label for="">tanggal akhir</label>
                            <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                id="tanggalakhir_riwayat" placeholder="Tanggal akhir ..">
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-dark mb-2 mt-4" onclick="caririwayatseppeserta()">Cari
                                Riwayat</button>
                        </div>
                    </div>
                </div>
                <div class="vkunjunganpasien">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalrujukan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Rujukan Peserta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body vrujukan">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    function caririwayatseppeserta() {       
            tglawal = $('#tanggalawal_riwayat').val()
            tglakhir = $('#tanggalakhir_riwayat').val()
            nomorkartu = $('#nomorkartu_riwayatsep').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tglawal,
                    tglakhir,
                    nomorkartu
                },
                url: '<?= route('vclaimcarikunjungansep_peserta');?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.vkunjunganpasien').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }

    function simpansep() {
        nomorkartu = $('#nomorkartu').val();
        penjamin = $('#penjamin').val();
        jenispelayanan = $('#jenispelayanan').val();
        polieksekutif = $('#polieksekutif:checked').val();
        politujuan = $('#politujuan').val();
        kodepolitujuan = $('#kodepolitujuan').val();
        namadokterlayan = $('#namadokterlayan').val();
        kodedokterlayan = $('#kodedokterlayan').val();
        asalrujukan = $('#asalrujukan').val();
        namappkrujukan = $('#namappkrujukan').val();
        kodeppkrujukan = $('#kodeppkrujukan').val();
        tglrujukan = $('#tglrujukan').val();
        nomorrujukan = $('#nomorrujukan').val();
        suratkontrol = $('#suratkontrol').val();
        namadpjp = $('#namadpjp').val();
        kodedpjp = $('#kodedpjp').val();
        tglsep = $('#tglsep').val();
        cob = $('#cob:checked').val();
        norm = $('#norm').val();
        naikkelas = $('#naikkelas:checked').val();
        kelasrawatnaik = $('#kelasrawatnaik').val();
        pembiayaan = $('#pembiayaan').val();
        penanggugjawab = $('#penanggugjawab').val();
        keteranganhakkelas = $('#keteranganhakkelas').val();
        hakkelas = $('#hakkelas').val();
        hakkelaspenuh = $('#hakkelaspenuh:checked').val();
        namaunitranap = $('#namaunitranap').val();
        kamarranap = $('#kamarranap').val();
        bedranap = $('#bedranap').val();
        namadiagnosa = $('#namadiagnosa').val();
        kodediagnosa = $('#kodediagnosa').val();
        nomortelepon = $('#nomortelepon').val();
        catatan = $('#catatan').val();
        katarak = $('#katarak:checked').val();
        alasanmasuk = $('#alasanmasuk').val();
        keterangan_kll = $('#keterangan_kll').val();
        keterangansuplesi = $('#keterangansuplesi:checked').val();
        sepsuplesi = $('#sepsuplesi').val();
        tglkejadianlaka = $('#tglkejadianlaka').val();
        nomorlp = $('#nomorlp').val();
        provinsikejadian = $('#provinsikejadian').val();
        kabupatenkejadian = $('#kabupatenkejadian').val();
        kecamatankejadian = $('#kecamatankejadian').val();
        keteranganlaka = $('#keteranganlaka').val();
        tujuankunjungan = $('#tujuankunjungan').val();
        flagprocedure = $('#flagprocedure').val();
        penunjang = $('#penunjang').val();
        asessment = $('#asessment').val();
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorkartu,
                penjamin,
                jenispelayanan,
                polieksekutif,
                politujuan,
                kodepolitujuan,
                namadokterlayan,
                kodedokterlayan,
                asalrujukan,
                namappkrujukan,
                kodeppkrujukan,
                tglrujukan,
                nomorrujukan,
                suratkontrol,
                namadpjp,
                kodedpjp,
                tglsep,
                cob,
                norm,
                naikkelas,
                kelasrawatnaik,
                pembiayaan,
                penanggugjawab,
                keteranganhakkelas,
                hakkelas,
                hakkelaspenuh,
                namaunitranap,
                kamarranap,
                bedranap,
                namadiagnosa,
                kodediagnosa,
                nomortelepon,
                catatan,
                katarak,
                alasanmasuk,
                keterangan_kll,
                keterangansuplesi,
                sepsuplesi,
                tglkejadianlaka,
                nomorlp,
                provinsikejadian,
                kabupatenkejadian,
                kecamatankejadian,
                keteranganlaka,
                tujuankunjungan,
                flagprocedure,
                penunjang,
                asessment
            },
            url: '<?= route('simpansep') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == '200') {
                    Swal.fire({
                        title: 'Pendaftaran berhasil !',
                        text: "Apakah anda ingin mencetak SEP ?",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, cetak SEP',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open('cetaksep/' + data.kode_kunjungan);
                            location.reload();
                        } else {
                            location.reload();
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops, maaf !',
                        text: data.message,
                    })
                }
            }
        });
    }

    function caripolikontrol() {
        spinner = $('#loader');
        spinner.show();
        jenis = $('#jenissurat').val()
        nomor = $('#nomorkartukontrol').val()
        tanggal = $('#tanggalkontrol').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jenis,
                nomor,
                tanggal
            },
            url: '<?= route('caripolikontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vpolikontrol').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }

    function caridokterkontrol() {
        spinner = $('#loader');
        spinner.show();
        jenis = $('#jenissurat').val()
        kodepoli = $('#kodepolikontrol').val()
        tanggal = $('#tanggalkontrol').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jenis,
                kodepoli,
                tanggal
            },
            url: '<?= route('caridokterkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vdokterkontrol').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }

    function buatsuratkontrol() {
        spinner = $('#loader');
        spinner.show();
        nomorkartu = $('#nomorkartukontrol').val()
        jenissurat = $('#jenissurat').val()
        tanggalkontrol = $('#tanggalkontrol').val()
        polikontrol = $('#polikontrol').val()
        kodepolikontrol = $('#kodepolikontrol').val()
        dokterkontrol = $('#dokterkontrol').val()
        kodedokterkontrol = $('#kodedokterkontrol').val()
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorkartu,
                jenissurat,
                tanggalkontrol,
                kodepolikontrol,
                kodedokterkontrol
            },
            url: '<?= route('buatsuratkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(data) {
                spinner.hide();
                if (data.metaData.code == 200) {
                    alert(data.metaData.message)
                } else {
                    alert(data.metaData.message)
                }
            }
        });
    }

    function carisuratkontrol() {
        spinner = $('#loader');
        spinner.show();
        nomorkartu = $('#nomorkartu').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorkartu
            },
            url: '<?= route('carisuratkontrol') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vspri').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }

    function carirujukan() {
        spinner = $('#loader');
        spinner.show();
        nomorkartu = $('#nomorkartu').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorkartu
            },
            url: '<?= route('carirujukan') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('.vrujukan').html(response);
                // $('#daftarpxumum').attr('disabled', true);
            }
        });
    }
    $(document).ready(function() {
        $('#namaunitranap').change(function() {
            kode_unit = $('#namaunitranap').val()
            hakkelas = $('#hakkelas').val()
            hakkelaspenuh = $('#hakkelaspenuh:checked').val()
            naikkelas = $('#naikkelas:checked').val()
            kelasrawatnaik = $('#kelasrawatnaik').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_unit,
                    hakkelas,
                    hakkelaspenuh,
                    naikkelas,
                    kelasrawatnaik
                },
                url: '<?= route('cariruangranap') ?>',
                success: function(response) {
                    $('#kamarranap').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        status = $('#status_kunjungan').val()
        if (status > 1) {
            Swal.fire({
                title: 'Kunjungan pasien masih aktif',
                text: "status pasien masih dalam kunjungan lain, silahkan tutup / batalkan kunjungan untuk melanjutkan pendaftaran !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lanjut Rawat Inap',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.simpanpendaftaran').removeAttr('Disabled',true)
                    $('#jenispelayanan').val(1)
                    $('#formranap').removeAttr('hidden', true)
                    $('.pilihpoli').attr('hidden', true)
                    $('.dokterlayan').attr('hidden', true)
                    $('#non-igd').removeAttr('Hidden', true);
                } else {
                    location.reload()
                }
            })
            $('.simpanpendaftaran').attr('Disabled',true)
        }
        $('#kamarranap').change(function() {
            kamarranap = $('#kamarranap').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kamarranap: kamarranap,
                },
                url: '<?= route('caribedranap') ?>',
                success: function(response) {
                    $('#bedranap').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(".preloader").fadeOut();
    $(function() {
        $("#tabelpolikontrol").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": false
        })
    });
    $(function() {
        $("#tabelriwayatkunjungan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            // "order": [
            //     [2, "desc"]
            // ]
        })
    });
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });

    function gantitujuan() {
        tujuan = $('#tujuankunjungan').val()
        if (tujuan != 0) {
            $('.fg').removeAttr('hidden', true)
            $('.pn').removeAttr('hidden', true)
        } else {
            $('.fg').attr('hidden', true)
            $('.pn').attr('hidden', true)
        }
    }

    function gantijenispelayanan() {
        jnsPelayanan = $('#jenispelayanan').val();
        if (jnsPelayanan == 1) {
            $('#formranap').removeAttr('hidden', true)
            $('.pilihpoli').attr('hidden', true)
            $('.dokterlayan').attr('hidden', true)
            $('#non-igd').removeAttr('Hidden', true);
        } else {
            $('.pilihpoli').removeAttr('hidden', true)
            $('.dokterlayan').removeAttr('hidden', true)
            $('#formranap').attr('hidden', true)
            $('#politujuan').val('INSTALASI GAWAT DARURAT');
            $('#kodepolitujuan').val('IGD');
            $('#non-igd').attr('Hidden', true);
        }
    }
    $(document).ready(function() {
        $('#politujuan').change(function() {
            var kodepoli = $('#kodepolitujuan').val()
            if (kodepoli == 'IGD') {
                $('#non-igd').attr('Hidden', true);
            } else {
                $('#non-igd').removeAttr('Hidden', true);
            }
        })
    });
    $(document).ready(function() {
        $('#politujuan').autocomplete({
            source: "<?= route('caripoli') ?>",
            select: function(event, ui) {
                spinner.show();
                $('[id="politujuan"]').val(ui.item.label);
                $('[id="kodepolitujuan"]').val(ui.item.kode);
                spinner.hide();

            }
        });
    });
    $(document).ready(function() {
        $('#namadokterlayan').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="namadokterlayan"]').val(ui.item.label);
                $('[id="kodedokterlayan"]').val(ui.item.kode);
            }
        });
    });
    $(document).ready(function() {
        $('#namadiagnosa').autocomplete({
            source: "<?= route('caridiagnosa') ?>",
            select: function(event, ui) {
                $('[id="namadiagnosa"]').val(ui.item.label);
                $('[id="kodediagnosa"]').val(ui.item.kode);
            }
        });
    });
    $("#naikkelas").click(function() {
        value = $('#naikkelas:checked').val()
        if (value == '1') {
            $('#formnaikkelas').removeAttr('hidden', true)
        } else {
            $('#formnaikkelas').attr('hidden', true)
        }
    });
    $(document).ready(function() {
        $('#keterangan_kll').change(function() {
            var status = $('#keterangan_kll').val()
            if (status == '' || status == '0') {
                $('#formlaka').attr('Hidden', true);
            } else {
                $('#formlaka').removeAttr('Hidden', true);
            }

        })
    });
    $(document).ready(function() {
        $('#provinsikejadian').change(function() {
            var sep_laka_prov = $('#provinsikejadian').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov: sep_laka_prov
                },
                url: '<?= route('carikabupaten') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kabupatenkejadian').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#kabupatenkejadian').change(function() {
            var sep_laka_kab = $('#kabupatenkejadian').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kab: sep_laka_kab
                },
                url: '<?= route('carikecamatan') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#kecamatankejadian').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
</script>
