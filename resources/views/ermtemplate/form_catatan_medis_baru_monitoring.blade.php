<div class="card">
    <div class="card-header bg-info">Catatan Medis Pasien</div>
    <div class="card-body">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/img/user.jpg') }}"
                        alt="User profile picture">
                </div>

                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} |
                    {{ $mt_pasien[0]->no_rm }}</h3>

                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-xs">Jenis Kelamin :
                    @if ($mt_pasien[0]->jenis_kelamin == 'P' || $mt_pasien[0]->jenis_kelamin == 'p')
                        Perempuan
                    @elseif ($mt_pasien[0]->jenis_kelamin == 'L' || $mt_pasien[0]->jenis_kelamin == 'l')
                        Laki - Laki
                    @else
                        {{ $mt_pasien[0]->jenis_kelamin }}
                    @endif
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <button class="btn btn-warning mb-2 scanrm_liat" rm="{{ $rm }}" data-toggle="modal"
            data-target="#modalscan_rm"><i class="bi bi-journal-text"></i> BERKAS RM SCAN</button>
        <button class="btn btn-danger mb-2 liatberkasluar" rm="{{ $rm }}" data-toggle="modal"
            data-target="#modalberkasluar"><i class="bi bi-journal-text"></i> BERKAS LAIN</button>
        <button class="btn btn-info mb-2 liathasil_lab" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalhasillab"><i class="bi bi-journal-text"></i> Hasil laboratorium</button>
        <button class="btn btn-info mb-2 liathasil_lab2" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalhasillab"><i class="bi bi-journal-text"></i> Hasil laboratorium Spesial Order</button>
        <button class="btn btn-info mb-2 liathasil_rad" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalhasilrad"><i class="bi bi-journal-text"></i> Hasil Radiologi</button>
        <button hidden class="btn btn-info mb-2 liathasil_pa" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalhasilpa"><i class="bi bi-journal-text"></i> Hasil Lab PA</button>
        <button class="btn btn-success mb-2 lihatcppt" nomorrm="{{ $rm }}"><i class="bi bi-journal-text"></i>
            CPPT( RAWAT JALAN )</button>
        <button class="btn btn-success mb-2 catatanmedis"><i class="bi bi-journal-text"></i> RIWAYAT KUNJUNGAN</button>
        <button class="btn btn-success mb-2 catatanmedis" data-toggle="modal" data-target="#modalsuratkonsul"><i
                class="bi bi-journal-text"></i>SURAT KONSUL / RUJUK INTERNAL </button>
        <button class="btn btn-success mb-2 lihat_catatan_hd" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalcatatanhemodialisa"><i class="bi bi-journal-text"></i>CATATAN HEMODIALISA</button>
        <button class="btn btn-info mb-2 lihat_catatan_prmj" nomorrm="{{ $rm }}" data-toggle="modal"
            data-target="#modalprmj"><i class="bi bi-journal-text"></i> Profil Ringkas Medis Rawat Jalan </button>
        <div hidden class="slide3">

        </div>
        <div class="accordion slide4" id="accordionExample">
            @php
                $urutan = 1;
            @endphp
            @foreach ($kunjungan as $k)
                <div class="card">
                    <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)"
                        id="headingOne{{ $k->kode_kunjungan }}{{ $urutan }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-dark text-bold" type="button"
                                data-toggle="collapse"
                                data-target="#collapse{{ $k->kode_kunjungan }}{{ $urutan }}"
                                aria-expanded="true" aria-controls="collapseOne">Nomor SEP : {{ $k->no_sep }}
                                <br><br>
                                Kunjungan Ke - {{ $k->counter }} | {{ $k->nama_unit }} @if ($k->kode_unit == '1028')
                                    | {{ $k->keterangan_cppt }}
                                    @endif @if ($k->ref_kunjungan != 0)
                                        <a class="text-bold text-dark"> | Pasien Konsul dari
                                            {{ $k->nama_ref_unit }}</a>
                                    @endif
                                    <p class="float-right">
                                        {{ \Carbon\Carbon::parse($k->tgl_masuk)->format('d / M / Y') }}</p>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{ $k->kode_kunjungan }}{{ $urutan }}" class="collapse"
                        aria-labelledby="headingOne{{ $k->kode_kunjungan }}{{ $urutan }}"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row mb-4 justify-content-end">
                                <div class="btn-group mr-2" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-secondary lihathasil_ex"
                                        kodekunjungan="{{ $k->kodek }}" data-toggle="modal"
                                        data-target="#modalhasil_ex"><i class="bi bi-eye mr-2"></i>
                                        Hasil Expertisi Radiologi</button>
                                    <button type="button" class="btn btn-secondary lihathasil_lab"
                                        kodekunjungan="{{ $k->kodek }}" data-toggle="modal"
                                        data-target="#modalhasil_lab"><i class="bi bi-eye mr-2"></i>Hasil
                                        Laboratorium</button>
                                    <button type="button" class="btn btn-secondary cetakresumesus"
                                        rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"
                                        kodekunjungan="{{ $k->kodek }}"><i
                                            class="bi bi-printer mr-2"></i>Assesmen
                                        Keperawatan</button>
                                    {{-- <button type="button" class="btn btn-secondary cetakresumedok"
                                        rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"
                                        unit="{{ $k->kode_unit }}"><i class="bi bi-printer mr-2"></i>Assesmen
                                        Medis</button> --}}
                                    <button type="button" class="btn btn-secondary cetakresumetanpattd"
                                        rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"
                                        unit="{{ $k->kode_unit }}" kodekunjungan="{{ $k->kodek }}"><i
                                            class="bi bi-printer mr-2"></i>Assesmen
                                        Medis </button>
                                    @if ($k->kode_unit == 1014)
                                        <button type="button" class="btn btn-secondary laporanoperasi"
                                            rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"
                                            unit="{{ $k->kode_unit }}" kodekunjungan="{{ $k->kodek }}"><i
                                                class="bi bi-printer mr-2"></i>Laporan Operasi </button>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-warning text-bold">Assesmen Keperawatan</div>
                                        @if ($k->id_1 != null)
                                            <div class="container">
                                                @if ($k->kode_unit != '1028')
                                                    <table class="table table-sm text-sm">
                                                        <tr>
                                                            <td class="text-bold font-italic">Sumber Data</td>
                                                            <td>{{ $k->sumber_data }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Keluhan Utama</td>
                                                            <td>{{ $k->keluhan_perawat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Umur</td>
                                                            <td>{{ $k->usia }} tahun</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Tekanan Darah</td>
                                                            <td>{{ $k->tekanandarah }} mmHg</td>
                                                            <td class="text-bold font-italic">Frekuensi Nadi</td>
                                                            <td>{{ $k->frekuensinadi }} x/menit</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Berat Badan / Tinggi
                                                                Badan
                                                                / IMT</td>
                                                            <td colspan="3">{{ $k->beratbadan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Frekuensi Nafas</td>
                                                            <td>{{ $k->frekuensinapas }} x/menit</td>
                                                            <td class="text-bold font-italic">Suhu</td>
                                                            <td>{{ $k->suhutubuh }} °C</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Riwayat Psikologis</td>
                                                            <td>{{ $k->Riwayatpsikologi }}</td>
                                                            <td class="text-bold font-italic">Keterangan</td>
                                                            <td>{{ $k->keterangan_riwayat_psikolog }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="bg-warning text-bold">Status
                                                                Fungsional</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Penggunaan Alat Bantu
                                                            </td>
                                                            <td>{{ $k->penggunaanalatbantu }}</td>
                                                            <td class="text-bold font-italic">Keterangan Alat Bantu
                                                            </td>
                                                            <td>{{ $k->keterangan_alat_bantu }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Cacat Tubuh</td>
                                                            <td>{{ $k->cacattubuh }}</td>
                                                            <td class="text-bold font-italic">Keterangan Cacat Tubuh
                                                            </td>
                                                            <td>{{ $k->keterangancacattubuh }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="bg-warning text-bold">Assesmen
                                                                Nyeri
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-bold font-italic">Keluhan Nyeri</td>
                                                            <td>{{ $k->Keluhannyeri }}</td>
                                                            <td class="text-bold font-italic">Keterangan</td>
                                                            <td>{{ $k->skalenyeripasien }}</td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <td class="text-bold font-italic">Cacat Tubuh</td>
                                                        <td>{{ $k->cacattubuh }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->keterangancacattubuh }}</td>
                                                    </tr> --}}
                                                        <tr>
                                                            <td colspan="4" class="text-bold bg-warning">Assesmen
                                                                resiko
                                                                jatuh</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Resiko Jatuh</td>
                                                            <td>{{ $k->resikojatuh }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" class="text-bold bg-warning">Skrinning
                                                                Gizi
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>1. Apakah pasien mengalami penurunan berat badan yang
                                                                tidak
                                                                diinginkan dalam 6 bulan terakhir ? </td>
                                                            <td>{{ $k->Skrininggizi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Keterangan </td>
                                                            <td>{{ $k->beratskrininggizi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2. Apakah asupan makanan berkurang karena berkurangnya
                                                                nafsu
                                                                makan</td>
                                                            <td>{{ $k->status_asupanmkanan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal
                                                                /
                                                                Hati / Paru / Stroke / Kanker / Penurunan imunitas
                                                                geriatri,
                                                                lain lain...</td>
                                                            <td>{{ $k->diagnosakhusus }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Keterangan </td>
                                                            <td>{{ $k->penyakitlainpasien }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>4. Bila skor >= 2, pasien beresiko malnutrisi dilakukan
                                                                pengkajian lanjut oleh ahli gizi</td>
                                                            <td>{{ $k->resikomalnutrisi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Keterangan </td>
                                                            <td>{{ $k->tglpengkajianlanjutgizi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Diagnosa Keperawatan</td>
                                                            <td>{{ $k->diagnosakeperawatan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rencana Keperawatan/Kebidanan/Terapis</td>
                                                            <td>{{ $k->rencanakeperawatan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tindakan Keperawatan/Kebidanan/Terapis</td>
                                                            <td>{{ $k->tindakankeperawatan }}<br>
                                                                <button class="btn btn-info riwayattindakan mt-4"
                                                                    kodekunjungan="{{ $k->kode_kunjungan }}"
                                                                    data-toggle="modal"
                                                                    data-target="#modalriwayattindakan">Riwayat
                                                                    Tindakan</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Evaluasi Keperawatan/Kebidanan/Terapis</td>
                                                            <td>{{ $k->evaluasikeperawatan }}</td>
                                                        </tr>
                                                    </table>
                                                @else
                                                    <div class="card mt-3">
                                                        <div class="card-header bg-success ">Hasil Pemeriksaan</div>
                                                        <div class="card-body">
                                                            {{ $k->tindakankeperawatan }}
                                                            <br><br><button class="btn btn-info riwayattindakan_fisio"
                                                                data-toggle="modal"
                                                                data-target="#modalriwayattindakan"
                                                                kodeunit="{{ $k->kode_unit }}"
                                                                keterangan="{{ $k->keterangan_cppt }}"
                                                                kodekunjungan="{{ $k->kode_kunjungan }}">Riwayat
                                                                Tindakan</button>
                                                        </div>
                                                    </div>
                                                @endif
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <th>Tanggal assesmen</th>
                                                        <th>Nama Pemeriksa</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $k->tanggalassemen }}</td>
                                                            <td>
                                                                <img src="{{ $k->signature_perawat }}"
                                                                    alt=""><br>
                                                                <p class="text-center">{{ $k->namapemeriksa }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                <h5 class="text-danger">Perawat Belum Mengisi ...</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-bold">Assesmen Medis</div>
                                        @if ($k->id_2 != null)
                                            <div class="card-body">
                                                @if ($k->kode_unit == '1028' || $k->kode_unit_dokter == '1028')
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="card">
                                                                    <table
                                                                        class="table table-bordered table-striped font-italic">
                                                                        <tr>
                                                                            <td>Anamnesa</td>
                                                                            <td>: {{ $k->anamnesa }}</td>
                                                                            <input hidden id="diagnosa"
                                                                                type="text"
                                                                                value="{{ $k->diagnosakerja }}">
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                                                                            <td>: {{ $k->pemeriksaan_fisik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Diagnosis Medis ( ICD 10 )</td>
                                                                            <td>: {{ $k->diagnosakerja }}</td>
                                                                            <input hidden id="diagnosa"
                                                                                type="text"
                                                                                value="{{ $k->diagnosakerja }}">
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Diagnosis Fungsi ( ICD 10 )</td>
                                                                            <td>: {{ $k->diagnosabanding }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Pemeriksaan Penunjang</td>
                                                                            <td>: {{ $k->rencanakerja }}

                                                                                <br>
                                                                                @if ($k->kode_unit == '1012' || $k->kode_unit == '1027')
                                                                                    Hasil Expertisi : <br>
                                                                                    {{ $k->evaluasi }}
                                                                                    <br>
                                                                                @endif
                                                                                <div class="card">
                                                                                    <div
                                                                                        class="card-header text-bold bg-secondary">
                                                                                        Terapi yang dilakukan
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <table class="table table-sm">
                                                                                            <thead>
                                                                                                <th>Unit</th>
                                                                                                <th>Nama Pemeriksaan
                                                                                                </th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($penunjang as $p)
                                                                                                    @if ($p->kode_kunjungan == $k->id_kunjungan)
                                                                                                        @if ($p->kode_unit == '3009' || $p->kode_unit == '3010')
                                                                                                            <tr>
                                                                                                                <td>{{ $p->nama_unit }}
                                                                                                                </td>
                                                                                                                <td>{{ $p->NAMA_TARIF }}
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div
                                                                                        class="card-header  text-bold bg-secondary">
                                                                                        Order yang dikirim
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <table
                                                                                            class="table table-sm table-bordered">
                                                                                            <thead>
                                                                                                <th>Nama Unit</th>
                                                                                                <th>Nama Layanan</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($order_penunjang as $d)
                                                                                                    @if ($d->kode_kunjungan == $k->id_kunjungan)
                                                                                                        <tr>
                                                                                                            <td>{{ $d->nama_unit }}
                                                                                                            </td>
                                                                                                            <td>{{ $d->NAMA_TARIF }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div
                                                                                        class="card-header text-bold bg-secondary">
                                                                                        Order yang dilayani
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <table class="table table-sm">
                                                                                            <thead>
                                                                                                <th>Unit</th>
                                                                                                <th>Nama Pemeriksaan
                                                                                                </th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($penunjang as $p)
                                                                                                    @if ($p->kode_kunjungan == $k->id_kunjungan)
                                                                                                        @if ($p->kode_unit != '3009' && $p->kode_unit != '3010')
                                                                                                            <tr>
                                                                                                                <td>{{ $p->nama_unit }}
                                                                                                                </td>
                                                                                                                <td>{{ $p->NAMA_TARIF }}
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tata laksana KFR </td>
                                                                            <td>: {{ $k->tatalaksana_kfr }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Anjuran </td>
                                                                            <td>: {{ $k->anjuran }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Evaluasi</td>
                                                                            <td>: {{ $k->evaluasi }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Suspek Penyakit akibat kerja</td>
                                                                            <td>: {{ $k->riwayatlain }}
                                                                                <br>
                                                                                ketereangan :
                                                                                {{ $k->ket_riwayatlain }}

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tindak Lanjut</td>
                                                                            <td>
                                                                                @if ($k->versidk != 2)
                                                                                    : {{ $k->tindak_lanjut }} |
                                                                                    {{ $k->keterangan_tindak_lanjut }}
                                                                                @else
                                                                                    @php $tinjut = explode('|',$k->tindak_lanjut ) @endphp
                                                                                    @if ($tinjut[0] == 1)
                                                                                        Kontrol <br>
                                                                                    @endif
                                                                                    @if ($tinjut[1] == 1)
                                                                                        Konsul <br>
                                                                                    @endif
                                                                                    @if ($tinjut[2] == 1)
                                                                                        Rujuk Internal <br>
                                                                                    @endif
                                                                                    @if ($tinjut[3] == 1)
                                                                                        Rujuak Keluar <br>
                                                                                    @endif
                                                                                    @if ($tinjut[4] == 1)
                                                                                        Rawat Inap <br>
                                                                                    @endif
                                                                                    @if ($tinjut[5] == 1)
                                                                                        Dipulangkan <br>
                                                                                    @endif
                                                                                @endif
                                                                                Keterangan :
                                                                                {{ $k->keterangan_tindak_lanjut }}<br><br>

                                                                                {{-- @foreach ($datakonsul as $dk)
                                                                                    @if ($dk->kode_kunjungan == $cp->id_kunjungan)
                                                                                        @if ($dk->jenis == 'KONSUL')
                                                                                            KONSUL KE POLI
                                                                                            {{ $dk->poli_konsul }} <br>
                                                                                            {{ $dk->catatan }}
                                                                                            <br><br><br>
                                                                                            JAWABAN KONSUL <br>
                                                                                            {{ $dk->dokter_penerima_2 }}
                                                                                            <br><br>
                                                                                            {{ $dk->jawaban_konsul }}
                                                                                        @else
                                                                                            RUJUK POLI LAIN (
                                                                                            {{ $dk->poli_konsul }})
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach --}}
                                                                                {{-- <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="goto_suratkontrol()"><i class="bi bi-plus mr-1 ml-1"></i>
                                                    Buat Surat Kontrol</button>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#modalkonsulantarpoli"><i
                                                        class="bi bi-plus mr-1 ml-1"></i> Konsul
                                                    antar poli</button>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#modalrujukinternal"><i
                                                        class="bi bi-plus mr-1 ml-1"></i> Rujuk
                                                    Internal </button>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#modalrujukkeluar"><i class="bi bi-plus mr-1 ml-1"></i>
                                                    Rujuk Keluar
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                    data-target="#modalrujukrawatinap"><i
                                                        class="bi bi-plus mr-1 ml-1"></i> Rawat Inap
                                                </button>
                                            </div> --}}
                                                                                <div class="v_riwayat_surat_rujin">

                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Obat obatan</td>
                                                                            <td>
                                                                                <div class="card">
                                                                                    <div
                                                                                        class="card-header text-bold bg-secondary">
                                                                                        Order yang dikirim
                                                                                        dokter</div>
                                                                                    <div class="card-body">
                                                                                        <table class="table table-sm">
                                                                                            <thead>
                                                                                                <th>Nama Obat</th>
                                                                                                <th>qty</th>
                                                                                                <th>Aturan Pakai</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($orderfarmasi as $t)
                                                                                                    @if ($t->kode_kunjungan == $k->id_kunjungan)
                                                                                                        <tr>
                                                                                                            <td>{{ $t->kode_barang }}
                                                                                                            </td>
                                                                                                            <td>{{ $t->jumlah_layanan }}
                                                                                                            </td>
                                                                                                            <td>{{ $t->aturan_pakai }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card">
                                                                                    <div
                                                                                        class="card-header text-bold bg-secondary">
                                                                                        Obat yang dilayani</div>
                                                                                    <div class="card-body">
                                                                                        <table class="table table-sm">
                                                                                            <thead>
                                                                                                <th>Nama Obat</th>
                                                                                                <th>qty</th>
                                                                                                <th>Aturan Pakai</th>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach ($farmasi as $t)
                                                                                                    @if ($t->kode_kunjungan == $k->id_kunjungan)
                                                                                                        <tr>
                                                                                                            <td>{{ $t->nama_barang }}
                                                                                                            </td>
                                                                                                            <td>{{ $t->jumlah_layanan }}
                                                                                                            </td>
                                                                                                            <td>{{ $t->aturan_pakai }}
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        {{-- <tr>
                                        <td>Pemeriksaan Penunjang</td>
                                        <td>
                                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                                Hasil Expertisi : <br>
                                                {{ $cp->evaluasi }}
                                                <br>
                                            @endif
                                            <div class="card">
                                                <div class="card-header  text-bold bg-secondary">Order yang dikirim
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-sm table-bordered">
                                                        <thead>
                                                            <th>Nama Unit</th>
                                                            <th>Nama Layanan</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order_penunjang as $d)
                                                                <tr>
                                                                    <td>{{ $d->nama_unit }}</td>
                                                                    <td>{{ $d->NAMA_TARIF }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header text-bold bg-secondary">Order yang dilayani
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <th>Unit</th>
                                                            <th>Nama Pemeriksaan</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penunjang as $p)
                                                                @if ($p->kode_kunjungan == $cp->id_kunjungan)
                                                                    @if ($p->kode_unit != '3009' && $p->kode_unit != '3010')
                                                                    <tr>
                                                                        <td>{{ $p->nama_unit }}
                                                                        </td>
                                                                        <td>{{ $p->NAMA_TARIF }}
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr> --}}
                                                                        <tr>
                                                                            <td>Jawaban Konsul Ke poli lain</td>
                                                                            <td>{{ $k->keterangan_tindak_lanjut_2 }}
                                                                                <br><br>
                                                                                {{-- @foreach ($datakonsul as $dk)
                                                                                    @if ($dk->kode_kunjungan_2 == $cp->id_kunjungan)
                                                                                        @if ($dk->jenis == 'KONSUL')
                                                                                            KONSUL DARI POLI
                                                                                            {{ $dk->poli_pengirim }}
                                                                                            <br>
                                                                                            {{ $dk->catatan }}
                                                                                            <br><br><br>
                                                                                            JAWABAN KONSUL <br>
                                                                                            {{ $dk->jawaban_konsul }}
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach --}}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tanggal Periksa</td>
                                                                            <td>{{ $k->tanggalassemen }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Dokter Pemeriksa</td>
                                                                            <td>{{ $k->nama_dokter }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                            {{-- <td>
                        {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                    </td> --}}
                                                        </tr>
                                                    </table>
                                                @elseif ($k->kode_unit == '1026')
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <th>Jenis Informasi</th>
                                                            <th>Isi Informasi</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Diagnosa ( WD & DD )</td>
                                                                <td>{{ $k->diagnosakerja }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dasar Diagnosa</td>
                                                                <td>{{ $k->diagnosabanding }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center bg-dark">
                                                                    ANAMNESA</td>
                                                            </tr>
                                                            <tr>
                                                                <td>A ( Alergi )</td>
                                                                <td>{{ $k->alergi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>M ( Medikasi )</td>
                                                                <td>{{ $k->medikasi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>P ( Post Illnes )</td>
                                                                <td>{{ $k->postillnes }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>L ( Last Meal )</td>
                                                                <td>{{ $k->lastmeal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>E ( Event )</td>
                                                                <td>{{ $k->event }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center bg-dark">
                                                                    PEMERIKSAAN FISIK</td>
                                                            </tr>
                                                            <tr>
                                                                <td>COR</td>
                                                                <td>{{ $k->cor }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pulmo</td>
                                                                <td>{{ $k->pulmo }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Gigi</td>
                                                                <td>{{ $k->gigi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Ekstremitas</td>
                                                                <td>{{ $k->ekstremitas }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center bg-dark">
                                                                    PENILAIAN EVALUASI JALAN NAFAS</td>
                                                            </tr>
                                                            @if ($k->LEMON != '')
                                                                @php $lemon = explode('|',$k->LEMON ) @endphp
                                                                <tr>
                                                                    <td>L</td>
                                                                    <td>{{ $lemon['0'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>E</td>
                                                                    <td>{{ $lemon['1'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>M</td>
                                                                    <td>{{ $lemon['2'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>O</td>
                                                                    <td>{{ $lemon['3'] }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>N</td>
                                                                    <td>{{ $lemon['4'] }}</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td>Lain - lain</td>
                                                                <td>{{ $k->lainlain }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Assesmen</td>
                                                                <td colspan="3">
                                                                    @if ($k->tindak_lanjut == 1)
                                                                        Setuju dijadwalkan operasi
                                                                    @elseif ($k->tindak_lanjut == 2)
                                                                        Saat ini keadaan pasien dalam kondisi belum
                                                                        untuk dilakukan tindakan anestesi
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold">Saran</td>
                                                                <td colspan="3">{{ $k->keterangan_tindak_lanjut }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jawaban Konsul</td>
                                                                <td>{{ $k->keterangan_tindak_lanjut_2 }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table class="table table-sm table-bordered mt-4">
                                                        <thead>
                                                            <th>Tanggal assesmen</th>
                                                            <th>Nama Pemeriksa</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $k->tanggalassemen }}</td>
                                                                <td>
                                                                    <img src="{{ $k->signature_dokter }}"
                                                                        alt=""><br>
                                                                    <p class="text-center">{{ $k->nama_dokter }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <table class="table table-sm table-bordered table-striped">
                                                        <tr>
                                                            <td>Sumber Data</td>
                                                            <td>{{ $k->sumber_data }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Keluhan Utama</td>
                                                            <td>{{ $k->keluhan_pasien }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Riwayat Penyakit Dahulu</td>
                                                            <td>{{ $k->riwayat_kehamilan_pasien_wanita }}
                                                                <br>
                                                                {{ $k->riwyat_kelahiran_pasien_anak }}
                                                                <br>
                                                                {{ $k->riwyat_penyakit_sekarang }}
                                                                <br>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Riwayat Alergi</td>
                                                            <td>{{ $k->riwayat_alergi }} |
                                                                {{ $k->keterangan_alergi }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Riwayat Obat yang diminum</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kesadaran</td>
                                                            <td colspan="3">{{ $k->kesadaran }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pemeriksaan Fisik ( O )</td>
                                                            <td>{{ $k->pemeriksaan_fisik }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Diagnosis ( A ) <br></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Diagnosa Utama</td>
                                                            <td>{{ $k->diagnosakerja }}<br>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Diagnosa Sekunder</td>
                                                            <td>{{ $k->diagnosabanding }}<br>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tindakan</td>
                                                            <td>
                                                                {{ $k->tindakanmedis }}<br>
                                                                @foreach ($tindakan as $t)
                                                                    @if ($t->kode_kunjungan == $k->id_kunjungan)
                                                                        {{ $t->NAMA_TARIF }}<br>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rencana Tindakan ( P )</td>
                                                            <td>{{ $k->renjana_tindakan }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Rencana Terapi ( P )</td>
                                                            <td>{{ $k->rencanakerja }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tindak Lanjut</td>
                                                            <td>{{ $k->tindak_lanjut }}<br>
                                                                {{ $k->keterangan_tindak_lanjut }} <br><br>
                                                                {{-- @foreach ($datakonsul as $dk)
                                                                    @if ($dk->kode_kunjungan == $cp->id_kunjungan)
                                                                        @if ($dk->jenis == 'KONSUL')
                                                                            KONSUL KE POLI {{ $dk->poli_konsul }} <br>
                                                                            {{ $dk->catatan }} <br><br><br>
                                                                            JAWABAN KONSUL <br>
                                                                            {{ $dk->dokter_penerima_2 }} <br><br>
                                                                            {{ $dk->jawaban_konsul }}
                                                                        @else
                                                                            RUJUK POLI LAIN ( {{ $dk->poli_konsul }})
                                                                        @endif
                                                                    @endif
                                                                @endforeach --}}
                                                                {{-- <div class="btn-group mb-3" role="group" aria-label="Basic example">
                                                                        <button type="button" class="btn btn-secondary" onclick="goto_suratkontrol()"><i
                                                                                class="bi bi-plus mr-1 ml-1"></i> Buat Surat Kontrol</button>
                                                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                                            data-target="#modalkonsulantarpoli"><i class="bi bi-plus mr-1 ml-1"></i> Konsul
                                                                            antar poli</button>
                                                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                                            data-target="#modalrujukinternal"><i class="bi bi-plus mr-1 ml-1"></i> Rujuk
                                                                            Internal </button>
                                                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                                            data-target="#modalrujukkeluar"><i class="bi bi-plus mr-1 ml-1"></i> Rujuk Keluar
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary" data-toggle="modal"
                                                                            data-target="#modalrujukrawatinap"><i class="bi bi-plus mr-1 ml-1"></i> Rawat Inap
                                                                        </button>
                                                                    </div> --}}
                                                                <div class="v_riwayat_surat_rujin">

                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Obat obatan</td>
                                                            <td>
                                                                <div class="card">
                                                                    <div class="card-header text-bold bg-secondary">
                                                                        Order yang dikirim dokter</div>
                                                                    <div class="card-body">
                                                                        <table class="table table-sm">
                                                                            <thead>
                                                                                <th>Nama Obat</th>
                                                                                <th>qty</th>
                                                                                <th>Aturan Pakai</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($orderfarmasi as $t)
                                                                                    @if ($t->kode_kunjungan == $k->id_kunjungan)
                                                                                        <tr>
                                                                                            <td>{{ $t->kode_barang }}
                                                                                            </td>
                                                                                            <td>{{ $t->jumlah_layanan }}
                                                                                            </td>
                                                                                            <td>{{ $t->aturan_pakai }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header text-bold bg-secondary">
                                                                        Obat yang dilayani</div>
                                                                    <div class="card-body">
                                                                        <table class="table table-sm">
                                                                            <thead>
                                                                                <th>Nama Obat</th>
                                                                                <th>qty</th>
                                                                                <th>Aturan Pakai</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($farmasi as $t)
                                                                                    @if ($t->kode_kunjungan == $k->id_kunjungan)
                                                                                        <tr>
                                                                                            <td>{{ $t->nama_barang }}
                                                                                            </td>
                                                                                            <td>{{ $t->jumlah_layanan }}
                                                                                            </td>
                                                                                            <td>{{ $t->aturan_pakai }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pemeriksaan Penunjang</td>
                                                            <td>
                                                                @if ($k->kode_unit == '1012' || $k->kode_unit == '1027')
                                                                    Hasil Expertisi : <br>
                                                                    {{ $k->evaluasi }}
                                                                    <br>
                                                                @endif
                                                                <div class="card">
                                                                    <div class="card-header  text-bold bg-secondary">
                                                                        Order yang dikirim</div>
                                                                    <div class="card-body">
                                                                        <table class="table table-sm table-bordered">
                                                                            <thead>
                                                                                <th>Nama Unit</th>
                                                                                <th>Nama Layanan</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($order_penunjang as $d)
                                                                                    @if ($d->kode_kunjungan == $k->id_kunjungan)
                                                                                        <tr>
                                                                                            <td>{{ $d->nama_unit }}
                                                                                            </td>
                                                                                            <td>{{ $d->NAMA_TARIF }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <div class="card">
                                                                    <div class="card-header text-bold bg-secondary">
                                                                        Order yang dilayani</div>
                                                                    <div class="card-body">
                                                                        <table class="table table-sm">
                                                                            <thead>
                                                                                <th>Unit</th>
                                                                                <th>Nama Pemeriksaan</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($penunjang as $p)
                                                                                    @if ($p->kode_kunjungan == $k->id_kunjungan)
                                                                                        <tr>
                                                                                            <td>{{ $p->nama_unit }}
                                                                                            </td>
                                                                                            <td>{{ $p->NAMA_TARIF }}
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jawaban Konsul Ke poli lain</td>
                                                            <td>{{ $k->keterangan_tindak_lanjut_2 }} <br><br>
                                                                {{-- @foreach ($datakonsul as $dk)
                                                                    @if ($dk->kode_kunjungan_2 == $cp->id_kunjungan)
                                                                        @if ($dk->jenis == 'KONSUL')
                                                                            KONSUL DARI POLI {{ $dk->poli_pengirim }}
                                                                            <br>
                                                                            {{ $dk->catatan }} <br><br><br>
                                                                            JAWABAN KONSUL <br>
                                                                            {{ $dk->jawaban_konsul }}
                                                                        @endif
                                                                    @endif
                                                                @endforeach --}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hasil Pemeriksaan Khusus</td>
                                                            <td>
                                                                {{-- <div class="card">
                                                                    <div class="card-header bg-danger">Hasil Pemeriksaan khusus
                                                                    </div>
                                                                    <div class="card-body"> --}}
                                                                {{ $k->pemeriksaan_khusus }} <br><br>
                                                                {{ $k->pemeriksaan_khusus_2 }}<br><br>
                                                                <img width="80%"src="{{ $k->gambar_1 }}"
                                                                    alt=""><br><br>
                                                                <img src="{{ $k->gambar_2 }}"
                                                                    alt=""><br><br>
                                                                {{-- </div>
                                                                </div> --}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Periksa</td>
                                                            <td>{{ $k->tanggalassemen }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Dokter pemeriksa</td>
                                                            <td>{{ $k->nama_dokter }}</td>
                                                        </tr>
                                                    </table>
                                                @endif
                                            </div>
                                        @else
                                            <div class="card-body">
                                                <h5 class="text-danger">Dokter Belum Mengisi ...</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $urutan = $urutan + 1;
                @endphp
            @endforeach
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsuratkonsul" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Konsul / Rujuk Internal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Tanggal</th>
                        <th>Unit Asal</th>
                        <th>Dokter Pengirim</th>
                        <th>Unit Tujuan</th>
                        <th>Dokter Penerima</th>
                        <th>Keterangan</th>
                        <th>Jawaban</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($suratkonsul as $d)
                            <tr>
                                <td>{{ $d->tanggal_surat }}</td>
                                <td>{{ $d->unit_asal }}</td>
                                <td>{{ $d->dok_kirim }}</td>
                                <td>{{ $d->unit_tujuan }}</td>
                                <td>{{ $d->dokter_jawab }}</td>
                                <td>{{ $d->keterangan_klinis }} <br> {{ $d->keterangan }}</td>
                                <td>{{ $d->jawaban }}</td>
                                <td>
                                    <button class="btn btn-success cetakdokumen"
                                        iddokumen="{{ $d->id }}">Cetak</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayattindakan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="riwayattindakan_m">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpemeriksaankhusus" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Khusus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="hslpmkh">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatupload" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Khusus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vru">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatorder" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vro">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatorderfarmasi" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vrof">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasil_lab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vhlab">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasil_ex" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Expertise</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vhex">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalscan_rm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BERKAS RM SCAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vrm_lama">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalberkasluar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">BERKAS DARI LUAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vberkasluar">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasillab" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_lab">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilrad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Radiologi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_rad">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Patologi Anatomi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_hasil_penunjang_pa">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalcatatanhemodialisa" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 95%; margin: 1.75rem auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Hemodialisa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_catatan_hd">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalprmj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 95%; margin: 1.75rem auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profil Ringkas Medis Rawat Jalan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_prmj">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".lihatcppt").click(function() {
        rm = $(this).attr('nomorrm')
        spinner = $('#loader')
        spinner.show();
        $('.slide4').attr('hidden', true)
        $('.slide3').removeAttr('hidden', true)
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('lihatcppt_pasien2') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
        // }
    })
    $(".catatanmedis").click(function() {
        $('.slide3').attr('hidden', true)
        $('.slide4').removeAttr('hidden', true)

    })
    $(".riwayatorderfarmasi").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatorderfarmasi2') ?>',
            success: function(response) {
                $('.vrof').html(response);
            }
        });
    });
    $(".riwayatorder").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatorder2') ?>',
            success: function(response) {
                $('.vro').html(response);
            }
        });
    });
    $(".riwayattindakan").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayattindakan2') ?>',
            success: function(response) {
                $('.riwayattindakan_m').html(response);
            }
        });
    });
    $(".riwayattindakan_fisio").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        kodeunit = $(this).attr('kodeunit')
        keterangan = $(this).attr('keterangan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                kodeunit,
                keterangan
            },
            url: '<?= route('riwayattindakan2') ?>',
            success: function(response) {
                $('.riwayattindakan_m').html(response);
            }
        });
    });
    $(".hasilpemeriksaankhusus").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('pemeriksaankhususon') ?>',
            success: function(response) {
                $('.hslpmkh').html(response);
            }
        });
    });
    $(".riwayatupload").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatupload') ?>',
            success: function(response) {
                $('.vru').html(response);
            }
        });
    });
    $(".cetakresumesus").on('click', function(event) {
        kode_kunjungan = $(this).attr('kodekunjungan')
        window.open('cetakresumeblank_perawat/' + kode_kunjungan);
    })
    $(".cetakresumedok").on('click', function(event) {
        rm = $(this).attr('rm')
        counter = $(this).attr('counter')
        unit = $(this).attr('unit')
        window.open('http://192.168.2.30/siramah/cppt_print?rm=' + rm + '&counter=' + counter + '&kode_unit=' +
            unit);
    })
    $(".cetakresumetanpattd").on('click', function(event) {
        kode_kunjungan = $(this).attr('kodekunjungan')
        window.open('cetakresumeblank/' + kode_kunjungan);
    })
    $(".lihathasil_lab").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('lihathasillab') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vhlab').html(response);
            }
        });
    })
    $(".lihathasil_ex").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('lihathasilex') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vhex').html(response);
            }
        });
    })
    $(".laporanoperasi").on('click', function(event) {
        kode_kunjungan = $(this).attr('kodekunjungan')
        window.open('cetaklaporanoperasi/' + kode_kunjungan);
    })
    $(".liathasil_lab2").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_lab2') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_lab').html(response);
                spinner.hide()
            }
        });
    })
    $(".scanrm_liat").on('click', function(event) {
        rm = $(this).attr('rm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('lihathasil_scanrm') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vrm_lama').html(response);
            }
        });
    })
    $(".liatberkasluar").on('click', function(event) {
        rm = $(this).attr('rm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('vberkasluar') ?>',
            error: function(data) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                spinner.hide();
                $('.vberkasluar').html(response);
            }
        });
    })
    $(".liathasil_lab").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_lab') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_lab').html(response);
                spinner.hide()
            }
        });
    })
    $(".liathasil_rad").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_rad') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_rad').html(response);
                spinner.hide()
            }
        });
    })
    $(".liathasil_pa").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('nomorrm')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm
            },
            url: '<?= route('lihathasilpenunjang_pa') ?>',
            success: function(response) {
                $('.v_hasil_penunjang_pa').html(response);
                spinner.hide()
            }
        });
    })
    $(".lihat_catatan_hd").click(function() {
        spinner = $('#loader')
        spinner.show();
        rm = $(this).attr('nomorrm')
        jenis = '1'
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                jenis
            },
            url: '<?= route('ambilriwayatcatatanhemodialisa') ?>',
            success: function(response) {
                $('.v_catatan_hd').html(response);
                spinner.hide()
            }
        });
    })
    $(".lihat_catatan_prmj").click(function() {
        spinner = $('#loader')
        spinner.show();
        rm = $(this).attr('nomorrm')
        jenis = '1'
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                jenis
            },
            url: '<?= route('ambilcatatanprmj') ?>',
            success: function(response) {
                $('.v_prmj').html(response);
                spinner.hide()
            }
        });
    })
</script>
<script>
    $(".cetakdokumen").on('click', function(event) {
        iddokumen = $(this).attr('iddokumen')
        window.open('cetaksuratpengantar/' + iddokumen)
    });
</script>
