<div class="container mt-3">
    <div class="card card-outline card-success">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header bg-info">Riwayat Kunjungan</div>
                <div class="card-body">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="bi bi-megaphone"></i> </strong> Pasien rawat inap harus terdaftar sebagai pasien igd atau rawat jalan ditanggal yang sama.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <button class="btn btn-danger"  data-toggle="modal"
                data-target="#modalriwayatsep"><i class="bi bi-search"></i> Riwayat SEP Terakhir</button> --}}
                    <table id="tabelriwayatkunjungan"
                        class="table table-bordered table-sm text-md table-hover table-striped">
                        <thead>
                            <th>Unit</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>PENJAMIN</th>
                            <th>Catatan</th>
                            <th>Dokter</th>
                            <th>SEP</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_kunjungan as $r)
                            <?php $datein = $r->tgl_masuk; 
                             $date_for = date('Y-d-m',strtotime($datein));
                                $datenow = date('Y-m-d');
                            ;?>
                                <tr>
                                    <td>{{ $r->nama_unit }}</td>
                                    <td><button class="badge badge-warning">{{ $date_for }}</button></td>
                                    <td>{{ $r->tgl_keluar }}</td>
                                    <td>{{ $r->nama_penjamin }}</td>
                                    <td>{{ $r->CATATAN }}</td>
                                    <td>{{ $r->dokter }}</td>
                                    <td>{{ $r->no_sep }}</td>
                                    <td>@if( $date_for === $datenow )<button kodedokter="{{ $r->kode_dokter }}" kodeunit={{ $r->kode_unit }}
                                            kodekunjungan="{{ $r->kode_kunjungan }}" unit="{{ $r->nama_unit }}"
                                            dokter="{{ $r->dokter }}"class="badge badge-info pilihrefranap">Referensi
                                            Ranap</button> @endif </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-2 justify-content-center">
            <div class="col-md-5">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-info">Data Pasien</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-right text-bold">Nomor RM</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="nomorrm_ranap"
                                        placeholder="" value="{{ $mt_pasien[0]->no_rm }}">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">NIK</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="nik_ranap" placeholder=""
                                        value="{{ $mt_pasien[0]->nik_bpjs }}">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Nomor BPJS</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="bpjs_ranap" placeholder=""
                                        value="{{ $mt_pasien[0]->no_Bpjs }}">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Nama Pasien</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="namapasien_ranap"
                                        placeholder="" value="{{ $mt_pasien[0]->nama_px }}">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Jenis Peserta</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="jenispeserta" placeholder=""
                                        value="">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Tanggal lahir</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="tgllahir" placeholder=""
                                        value="">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Faskes 1</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="faskes1" placeholder=""
                                        value="">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Status</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="statuspeserta"
                                        placeholder="" value="">
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-4 text-right text-bold">Hak kelas</div>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control" id="hakkelasinfo" placeholder=""
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="infopasienbpjs2">

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-info">Pasien Rawat Inap</div>
                        <div class="card-body">
                            <h4 class="text-danger mb-2">*Wajib Diisi</h4>                            
                            <div class="row">
                                <div class="col-sm-4 text-right text-bold">Jenis Pelayanan</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="jenispelayanan_ranap"
                                        onchange="gantijenispelayanan()">
                                        <option value="1">Rawat Inap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Bridging Bpjs</div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" value="1"
                                        id="pakebridgingga">
                                    <label style="font-size:12px"class="form-check-label text-danger"
                                        for="exampleCheck1">*ceklis jika pendaftaran menggunakan bridging dengan
                                        bpjs.</label>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Penjamin</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="penjamin_ranap">
                                        <option value=""> -- Silahkan Pilih Penjamin -- </option>
                                        @foreach ($mt_penjamin as $a)
                                            <option value="{{ $a->kode_penjamin }}">
                                                {{ $a->nama_penjamin }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="ranap" id="ranap">
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Hak Kelas</div>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="hakkelasbpjs">
                                            <option value="">-- Silahkan Pilih Kelas --</option>
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="4">VIP</option>
                                            <option value="5">VVIP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Naik Kelas</div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" value="1"
                                            id="naikkelas">
                                        <label style="font-size:15"class="form-check-label text-danger"
                                            for="exampleCheck1">*ceklis jika pasien naik kelas.</label>
                                    </div>
                                </div>
                                <div hidden class="jikanaikkelas">
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
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Kelas</div>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="kelasranap">
                                            <option value="">-- Silahkan Pilih Kelas --</option>
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="4">VIP</option>
                                            <option value="5">VVIP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Unit</div>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="unitranap">
                                            <option value="">-- Silahkan Pilih Unit --</option>
                                            {{-- @foreach ($mt_unit as $a)
                                                <option value="{{ $a->kode_unit }}">
                                                    {{ $a->nama_unit }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Kamar / Bed</div>
                                    <div class="col-sm-7">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="namaruanganranap" placeholder="nama ruangan">
                                            </div>
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="kodebedranap" placeholder="kode tempat tidur">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="idruangan" placeholder="kode tempat tidur">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#modalpilihruangan" onclick="cariruangan()"
                                                    class="btn btn-primary mb-2">Pilih ruangan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Referensi Kunjungan</div>
                                    <div class="col-sm-7">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="unitref" placeholder="Unit">
                                            </div>
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="dokterref" placeholder="Dokter">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="kodekunjunganref">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="kodedokter_ref">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="kodeunit_ref">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Tgl masuk</div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control datepicker"
                                        data-date-format="yyyy-mm-dd" id="tglmasukranap">
                                </div>
                            </div>
                            <div hidden id="pakebridging">
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold"></div>
                                    <div class="form-group form-check">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalbuatspri">Buat SPRI</button>
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#modalcarispri" onclick="carisuratkontrol()">Cari SPRI</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Nomor SPRI</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="nomorspri">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Tanggal SPRI</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control datepicker"
                                            data-date-format="yyyy-mm-dd" id="tglspri">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">DPJP SPRI</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"id="dpjp">
                                        <input hidden type="text" class="form-control" id="kodedpjp">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Diagnosa</div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="diagnosaranap">
                                        <input hidden type="text" class="form-control" id="kodediagnosaranap">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Catatan</div>
                                    <div class="col-sm-7">
                                        <textarea type="text" class="form-control" id="catatan"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Status Kecelakaan</div>
                                    <div class="col-sm-7">
                                        <select class="form-control form-control-sm" id="keterangan_kll">
                                            <option value="">-- Silahkan Pilih --</option>
                                            <option selected value="0">Bukan Kecelakaan lalu lintas [BKLL]
                                            </option>
                                            <option value="1">KLL dan bukan kecelakaan Kerja [BKK]</option>
                                            <option value="2">KLL dan KK</option>
                                            <option value="3">Kecelakaan Kerja</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div hidden class="formlaka">
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
                                        <input type="text" class="form-control datepicker"
                                            data-date-format="yyyy-mm-dd" id="tglkejadianlaka">
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
                                <div class="col-sm-4 text-right text-bold">Alasan masuk</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="alasanmasuk">
                                        @foreach ($alasan_masuk as $a)
                                            <option value="{{ $a->id }}"
                                                @if ($a->id == 1) selected @endif>
                                                {{ $a->alasan_masuk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mt-4">
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-7">
                                    <button class="btn btn-danger" onclick="location.reload()">Batal</button>
                                    <button class="btn btn-success float-right"
                                        onclick="daftarpasienranap()">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalpilihruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewruangan2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
<!-- Modal -->
<div class="modal fade" id="modalbuatspri" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                        {{-- <option value="2">SURAT KONTROL</option> --}}
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
                        value="" placeholder="name@example.com">
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
<script>
    $(function() {
        $("#tabelriwayatkunjungan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "ordering": true,
            "columnDefs": [{
                "targets": 0,
                "type": "date"
            }],
            // "order": [
            //     [1, "desc"]
            // ]
        })
    });
    $('#tabelriwayatkunjungan').on('click', '.pilihrefranap', function() {
        kode = $(this).attr('kodekunjungan')
        dokter = $(this).attr('dokter')
        unit = $(this).attr('unit')
        kodedokter = $(this).attr('kodedokter')
        kodeunit = $(this).attr('kodeunit')
        $('#kodekunjunganref').val(kode)
        $('#dokterref').val(dokter)
        $('#unitref').val(unit)
        $('#kodeunit_ref').val(kodeunit)
        $('#kodedokter_ref').val(kodedokter)
    });
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });
    $("#naikkelas").click(function(){
        value2 = $('#naikkelas:checked').val()
        if(value2 == '1'){
            $('.jikanaikkelas').removeAttr('hidden', true)
        }else{
            $('.jikanaikkelas').attr('hidden', true)
        }
    })
    $("#pakebridgingga").click(function() {
        spinner = $('#loader');
        spinner.show();
        value = $('#pakebridgingga:checked').val()
        noka = $('#bpjs_ranap').val()
        if (value == '1') {
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    noka
                },
                url: '<?= route('cariinfopasienbpjs2') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(data) {
                    spinner.hide();
                    $('#penjamin_ranap').val(data.penjamin.kode_penjamin_simrs)
                    $('#kelasranap').val(data.data_peserta.response.peserta.hakKelas.kode)
                    $('#hakkelasbpjs').val(data.data_peserta.response.peserta.hakKelas.kode)
                    $('#jenispeserta').val(data.data_peserta.response.peserta.jenisPeserta
                        .keterangan)
                    $('#tgllahir').val(data.data_peserta.response.peserta.tglLahir)
                    $('#faskes1').val(data.data_peserta.response.peserta.provUmum.nmProvider)
                    $('#statuspeserta').val(data.data_peserta.response.peserta.statusPeserta
                        .keterangan)
                    $('#hakkelasinfo').val(data.data_peserta.response.peserta.hakKelas.keterangan)
                    $('#nomorkartukontrol').val(data.data_peserta.response.peserta.noKartu)
                    kelas = data.data_peserta.response.peserta.hakKelas.kode
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            kelas
                        },
                        url: '<?= route('cariunit_kelas') ?>',
                        success: function(response) {
                            spinner.hide();
                            $('#unitranap').html(response);
                            // $('#daftarpxumum').attr('disabled', true);
                        }
                    });
                }
            });
            $('#pakebridging').removeAttr('hidden', true)
        } else {
            spinner.hide();
            $('#pakebridging').attr('hidden', true)
        }
    });
    $(document).ready(function() {
        $('#diagnosaranap').autocomplete({
            source: "<?= route('caridiagnosa') ?>",
            select: function(event, ui) {
                $('[id="diagnosaranap"]').val(ui.item.label);
                $('[id="kodediagnosaranap"]').val(ui.item.kode);
            }
        });
    });

    function cariruangan() {
        kelas = $('#kelasranap').val()
        unit = $('#unitranap').val()
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kelas,
                unit
            },
            url: '<?= route('cariruangranap2') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('#viewruangan2').html(response);
            }
        });
    }

    function daftarpasienranap() {
        nomorrm_ranap = $('#nomorrm_ranap').val()
        nik_ranap = $('#nik_ranap').val()
        bpjs_ranap = $('#bpjs_ranap').val()
        namapasien_ranap = $('#namapasien_ranap').val()
        jenispelayanan_ranap = $('#jenispelayanan_ranap').val()
        pakebridgingga = $('#pakebridgingga:checked').val()
        penjamin_ranap = $('#penjamin_ranap').val()
        kelasranap = $('#kelasranap').val()
        hakkelasbpjs = $('#hakkelasbpjs').val()
        unitranap = $('#unitranap').val()
        namaruanganranap = $('#namaruanganranap').val()
        kodebedranap = $('#kodebedranap').val()
        idruangan = $('#idruangan').val()
        unitref = $('#unitref').val()
        dokterref = $('#dokterref').val()
        kodekunjunganref = $('#kodekunjunganref').val()
        tglmasukranap = $('#tglmasukranap').val()
        naikkelas = $('#naikkelas:checked').val()
        pembiayaan = $('#pembiayaan').val()  
        penanggugjawab = $('#penanggugjawab').val() 
        nomorspri = $('#nomorspri').val()
        tglspri = $('#tglspri').val()
        dpjp = $('#dpjp').val()
        kodedpjp = $('#kodedpjp').val()
        diagnosaranap = $('#diagnosaranap').val()
        kodediagnosaranap = $('#kodediagnosaranap').val()
        catatan = $('#catatan').val()
        keterangan_kll = $('#keterangan_kll').val()
        alasanmasuk = $('#alasanmasuk').val()
        keterangansuplesi = $('#keterangansuplesi').val()
        sepsuplesi = $('#sepsuplesi').val()
        tglkejadianlaka = $('#tglkejadianlaka').val()
        nomorlp = $('#nomorlp').val()
        provinsikejadian = $('#provinsikejadian').val()
        kabupatenkejadian = $('#kabupatenkejadian').val()
        kecamatankejadian = $('#kecamatankejadian').val()
        keteranganlaka = $('#keteranganlaka').val()
        kodedokter_ref = $('#kodedokter_ref').val()
        kodeunit_ref = $('#kodeunit_ref').val()
        spinner = $('#loader');
        spinner.show()
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm_ranap,
                nik_ranap,
                bpjs_ranap,
                namapasien_ranap,
                jenispelayanan_ranap,
                pakebridgingga,
                penjamin_ranap,
                kodedokter_ref,
                kodeunit_ref,
                kelasranap,
                hakkelasbpjs,
                unitranap,
                namaruanganranap,
                kodebedranap,
                idruangan,
                unitref,
                dokterref,
                kodekunjunganref,
                tglmasukranap,
                naikkelas,
                pembiayaan,
                penanggugjawab,
                nomorspri,
                tglspri,
                dpjp,
                kodedpjp,
                diagnosaranap,
                kodediagnosaranap,
                catatan,
                keterangan_kll,
                alasanmasuk,
                keterangansuplesi,
                sepsuplesi,
                tglkejadianlaka,
                nomorlp,
                provinsikejadian,
                kabupatenkejadian,
                kecamatankejadian,
                keteranganlaka
            },
            url: '<?= route('daftarpasien_ranap') ?>',
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
                    if(data.jenis == 'BPJS'){
                        Swal.fire({
                        title: 'Pendaftaran berhasil !',
                        text: "Apakah anda ingin mencetak SEP ?",
                        icon: 'success',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        denyButtonColor: 'green',
                        confirmButtonText: 'Ya, cetak SEP',
                        denyButtonText: `Cetak SEP dan Label`,
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open('cetaksep/' + data.kode_kunjungan);
                            location.reload();
                        }else if (result.isDenied) {
                            // window.open('cetakstruk/' + data.kode_kunjungan);
                            // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                            var url = 'cetaksep/' + data.kode_kunjungan
                            var url2 = `http://192.168.2.45/printlabel/cetaklabel.php?rm=`+norm+`&nama=`+data.nama;
                            var locs = [url,url2] 
                            for (let i = 0; i < locs.length; i++) {
				                window.open(locs[i])}
                            location.reload();
                        } else {
                            location.reload();
                        }
                    })
                    }else{
                        Swal.fire({
                        title: 'Pendaftaran berhasil !',
                        text: "Cetak nota pembayaran ...",
                        icon: 'success',
                        showCancelButton: true,
                        showDenyButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        denyButtonColor: 'green',
                        denyButtonText: `Cetak Nota dan Label`,
                        confirmButtonText: 'Ya, cetak Nota',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open('cetakstruk/' + data.kode_kunjungan);
                            location.reload();
                        } else if (result.isDenied) {
                            // window.open('cetakstruk/' + data.kode_kunjungan);
                            // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                            var url = 'cetakstruk/' + data.kode_kunjungan
                            var url2 =
                                `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                nomorrm + `&nama=` + namapasien;
                            var locs = [url, url2]
                            for (let i = 0; i < locs.length; i++) {
                                window.open(locs[i])
                            }
                            location.reload();
                        } else {
                            location.reload();
                        }
                    })
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops, Sorry !',
                        text: data.message,
                    })
                }
            }
        });
    }

    function daftarpasienumum() {
        jenispelayanan = $('#jenispelayanan').val()
        namapasien = $('#namapasien').val()
        nomorrm = $('#nomorrm').val()
        politujuan = $('#politujuan').val()
        kodepolitujuan = $('#kodepolitujuan').val()
        tglmasuk = $('#tglmasuk').val()
        penjamin = $('#penjamin').val()
        sep = $('#sep').val()
        alasanmasuk = $('#alasanmasuk').val()
        kelasranap = $('#kelasranap').val()
        unitranap = $('#unitranap').val()
        namaruanganranap = $('#namaruanganranap').val()
        kodebedranap = $('#kodebedranap').val()
        idruangan = $('#idruangan').val()
        koderef = $('#kodekunjunganref').val()
        dokterref = $('#dokterref').val()
        if (kodepolitujuan == '') {
            if (jenispelayanan == 1) {
                if (koderef == '') {
                    alert('Pilih referensi kunjungan ditabel riwayat kunjungan ...')
                } else {
                    spinner = $('#loader');
                    spinner.show();
                    $.ajax({
                        async: true,
                        dataType: 'Json',
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            jenispelayanan,
                            namapasien,
                            nomorrm,
                            tglmasuk,
                            penjamin,
                            sep,
                            alasanmasuk,
                            kelasranap,
                            unitranap,
                            idruangan,
                            namaruanganranap,
                            kodebedranap,
                            koderef,
                            dokterref
                        },
                        url: '<?= route('daftarpasien_umum') ?>',
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
                                    text: "Cetak nota pembayaran ...",
                                    icon: 'success',
                                    showCancelButton: true,
                                    showDenyButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    denyButtonColor: 'green',
                                    denyButtonText: `Cetak Nota dan Label`,
                                    confirmButtonText: 'Ya, cetak Nota',
                                    cancelButtonText: 'Tidak'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.open('cetakstruk/' + data.kode_kunjungan);
                                        location.reload();
                                    } else if (result.isDenied) {
                                        // window.open('cetakstruk/' + data.kode_kunjungan);
                                        // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                        var url = 'cetakstruk/' + data.kode_kunjungan
                                        var url2 =
                                            `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                            nomorrm + `&nama=` + namapasien;
                                        var locs = [url, url2]
                                        for (let i = 0; i < locs.length; i++) {
                                            window.open(locs[i])
                                        }
                                        location.reload();
                                    } else {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops, Sorry !',
                                    text: data.message,
                                })
                            }
                        }
                    });
                    //end of pasien ranap
                }
            } else {
                alert('silahkan pilih poli tujuan ...')
            }
        } else {
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jenispelayanan,
                    namapasien,
                    nomorrm,
                    politujuan,
                    kodepolitujuan,
                    tglmasuk,
                    penjamin,
                    sep,
                    alasanmasuk
                },
                url: '<?= route('daftarpasien_umum') ?>',
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
                            text: "Cetak nota pembayaran ...",
                            icon: 'success',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            denyButtonColor: 'green',
                            denyButtonText: `Cetak Nota dan Label`,
                            confirmButtonText: 'Ya, cetak Nota',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('cetakstruk/' + data.kode_kunjungan);
                                location.reload();
                            } else if (result.isDenied) {
                                // window.open('cetakstruk/' + data.kode_kunjungan);
                                // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                var url = 'cetakstruk/' + data.kode_kunjungan
                                var url2 = `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                    nomorrm + `&nama=` + namapasien;
                                var locs = [url, url2]
                                for (let i = 0; i < locs.length; i++) {
                                    window.open(locs[i])
                                }
                                location.reload();
                            } else {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops, Sorry !',
                            text: data.message,
                        })
                    }
                }
            });
        }
    }
    $(document).ready(function() {
        $('#kelasranap').change(function() {
            var kelas = $('#kelasranap').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kelas
                },
                url: '<?= route('cariunit_kelas') ?>',
                success: function(response) {
                    spinner.hide();
                    $('#unitranap').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#keterangan_kll').change(function() {
            var status = $('#keterangan_kll').val()
            if (status == '' || status == '0') {
                $('.formlaka').attr('Hidden', true);
            } else {
                $('.formlaka').removeAttr('Hidden', true);
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
                    $('#nomorspri').val(data.response.noSPRI)
                    $('#tglspri').val(data.response.tglRencanaKontrol)
                    $('#dpjp').val(dokterkontrol)
                    $('#kodedpjp').val(kodedokterkontrol)
                    $('#staticBackdrop').modal('hide');
                } else {
                    alert(data.metaData.message)
                }
            }
        });
    }
    function carisuratkontrol() {
        spinner = $('#loader');
        spinner.show();
        nomorkartu = $('#bpjs_ranap').val()
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
</script>



