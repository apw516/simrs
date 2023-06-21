<div class="card">
    <div class="card-header bg-info"><button class="btn btn-light mr-2" onclick="location.reload()"> <i class="bi bi-backspace ml-2"></i> Kembali</button> Catatan Medis Pasien </div>
    <div class="card-body">
        <button class="btn btn-warning mb-2 scanrm_liat" rm="{{ $rm }}" data-toggle="modal"
            data-target="#modalscan_rm"><i class="bi bi-journal-text"></i> BERKAS RM SCAN</button>
        <button class="btn btn-danger mb-2 liatberkasluar" rm="{{ $rm }}" data-toggle="modal"
            data-target="#modalberkasluar"><i class="bi bi-journal-text"></i> BERKAS LAIN</button>
        <div class="accordion" id="accordionExample">
            <div class="row">

                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="{{ asset('public/img/user.jpg') }}" alt="User profile picture">
                            </div>

                            <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} |
                                {{ $mt_pasien[0]->no_rm }}</h3>

                            <p class="text-bold text-center text-xs"></p>
                            <p class="text-bold text-center text-xs">,
                                {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                                (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                            <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-12">
                    @foreach ($kunjungan as $k)
                        <div class="card">
                            <div class="card-header" style="background-color: rgba(110, 245, 137, 0.745)"
                                id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left text-dark text-bold" type="button"
                                        data-toggle="collapse" data-target="#collapse{{ $k->counter }}"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        Kunjungan Ke - {{ $k->counter }} | {{ $k->nama_unit }} <p
                                            class="float-right">
                                            {{ $k->tgl_masuk }}</p>
                                    </button>
                                </h2>
                            </div>
                            <div id="collapse{{ $k->counter }}" class="collapse" aria-labelledby="headingOne"
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
                                                rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"><i
                                                    class="bi bi-printer mr-2"></i>Assesmen
                                                Awal Keperawatan</button>
                                            <button type="button" class="btn btn-secondary cetakresumedok"
                                                rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"><i
                                                    class="bi bi-printer mr-2"></i>Assesmen Awal Medis</button>
                                        </div>

                                        {{-- <div class="col-md-4">
                        <button class="btn btn-secondary mb-2 float-right cetakresumedok ml-2"
                            rm="{{ $k->no_rm_k }}" counter="{{ $k->counter }}"
                            kodekunjungan_asskep="{{ $k->kodek }}"><i class="bi bi-printer"></i>
                            Download assesmen awal keperawatan </button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-secondary mb-2 float-right cetakresumesus"
                            kodekunjungan="{{ $k->kodek }}"><i class="bi bi-printer"></i>
                            Download assesmen awal medis</button>
                    </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header bg-warning text-bold">Assesmen awal Keperawatan
                                                </div>
                                                @if ($k->id_1 != null)
                                                    <div class="container">
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
                                                                <td class="text-bold font-italic">Frekuensi Nafas</td>
                                                                <td>{{ $k->frekuensinapas }} x/menit</td>
                                                                <td class="text-bold font-italic">Suhu</td>
                                                                <td>{{ $k->suhutubuh }} °C</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Riwayat Psikologis
                                                                </td>
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
                                                                <td colspan="4" class="text-bold bg-warning">
                                                                    Skrinning Gizi
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>1. Apakah pasien mengalami penurunan berat badan
                                                                    yang tidak
                                                                    diinginkan dalam 6 bulan terakhir ? </td>
                                                                <td>{{ $k->Skrininggizi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Keterangan </td>
                                                                <td>{{ $k->beratskrininggizi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2. Apakah asupan makanan berkurang karena
                                                                    berkurangnya nafsu
                                                                    makan</td>
                                                                <td>{{ $k->status_asupanmkanan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3. Pasien dengan diagnosa khusus : Penyakit DM /
                                                                    Ginjal /
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
                                                                <td>4. Bila skor >= 2, pasien beresiko malnutrisi
                                                                    dilakukan
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
                                                                <td>Rencana Keperawatan/Kebidanan</td>
                                                                <td>{{ $k->rencanakeperawatan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tindakan Keperawatan/Kebidanan</td>
                                                                <td>{{ $k->tindakankeperawatan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Evaluasi Keperawatan/Kebidanan</td>
                                                                <td>{{ $k->evaluasikeperawatan }}</td>
                                                            </tr>
                                                        </table>
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
                                                <div class="card-header bg-danger text-bold">Assesmen awal Medis</div>
                                                @if ($k->id_2 != null)
                                                    <div class="card-body">
                                                        <table class="table table-sm text-sm">
                                                            <tr>
                                                                <td class="text-bold font-italic">Sumber Data</td>
                                                                <td>{{ $k->sumber_data }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Keluhan Pasien</td>
                                                                <td>{{ $k->keluhan_pasien }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Tekanan Darah</td>
                                                                <td>{{ $k->tekanan_darah }} mmHg</td>
                                                                <td class="text-bold font-italic">Frekuensi Nafas</td>
                                                                <td>{{ $k->frekuensi_nafas }} x/menit</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Frekuensi Nadi</td>
                                                                <td>{{ $k->frekuensi_nadi }} x/menit</td>
                                                                <td class="text-bold font-italic">Suhu Tubuh</td>
                                                                <td>{{ $k->suhu_tubuh }} °C</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-bold bg-danger">Riwayat
                                                                    Kesehatan
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Riwayat Kehamilan
                                                                    (bagi
                                                                    pasien
                                                                    wanita)</td>
                                                                <td>{{ $k->riwayat_kehamilan_pasien_wanita }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Riwayat Kelahiran
                                                                    (bagi
                                                                    pasien
                                                                    anak) </td>
                                                                <td>{{ $k->riwyat_kelahiran_pasien_anak }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Riwayat Penyakit
                                                                    Sekarang
                                                                </td>
                                                                <td>{{ $k->riwyat_penyakit_sekarang }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-bold bg-danger">Riwayat
                                                                    Penyakit
                                                                    Dahulu</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Hipertensi</td>
                                                                <td>{{ $k->hipertensi }}</td>
                                                                <td class="text-bold font-italic">Kencing Manis</td>
                                                                <td>{{ $k->kencingmanis }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Jantung</td>
                                                                <td>{{ $k->jantung }}</td>
                                                                <td class="text-bold font-italic">Stroke</td>
                                                                <td>{{ $k->stroke }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Hepatitis</td>
                                                                <td>{{ $k->hepatitis }}</td>
                                                                <td class="text-bold font-italic">Asthma</td>
                                                                <td>{{ $k->asthma }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Ginjal</td>
                                                                <td>{{ $k->ginjal }}</td>
                                                                <td class="text-bold font-italic">TbParu</td>
                                                                <td>{{ $k->tbparu }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Lainnya</td>
                                                                <td>{{ $k->riwayatlain }}</td>
                                                                <td class="text-bold font-italic">Keterangan</td>
                                                                <td>{{ $k->ket_riwayatlain }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Riwayat Alergi</td>
                                                                <td>{{ $k->riwayat_alergi }}</td>
                                                                <td class="text-bold font-italic">Keterangan</td>
                                                                <td>{{ $k->keterangan_alergi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Status Generalis</td>
                                                                <td>{{ $k->statusgeneralis }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-bold bg-danger">
                                                                    Pemeriksaan
                                                                    Fisik
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4">{{ $k->pemeriksaan_fisik }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="text-bold bg-danger">
                                                                    Pemeriksaan
                                                                    Umum
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Keadaan Umum</td>
                                                                <td>{{ $k->keadaanumum }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Kesadaran</td>
                                                                <td>{{ $k->kesadaran }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Diagnosa Kerja</td>
                                                                <td>{{ $k->diagnosakerja }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Diagnosa Banding</td>
                                                                <td>{{ $k->diagnosabanding }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Rencana Kerja</td>
                                                                <td>{{ $k->rencanakerja }} <br>
                                                                    <button class="btn btn-warning riwayatorder mt-4"
                                                                        kodekunjungan="{{ $k->id_kunjungan }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modalriwayatorder">Riwayat Order
                                                                        Penunjang</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Tindakan Medis</td>
                                                                <td>{{ $k->tindakanmedis }}<br>
                                                                    <button class="btn btn-info riwayattindakan mt-4"
                                                                        kodekunjungan="{{ $k->id_kunjungan }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modalriwayattindakan">Riwayat
                                                                        Tindakan</button>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Order Farmasi</td>
                                                                <td> <button
                                                                        class="btn btn-warning riwayatorderfarmasi mt-4"
                                                                        kodekunjungan="{{ $k->id_kunjungan }}"
                                                                        data-toggle="modal"
                                                                        data-target="#modalriwayatorderfarmasi">Riwayat
                                                                        Order
                                                                        Farmasi</button></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-bold font-italic">Tindak Lanjut</td>
                                                                <td>{{ $k->tindak_lanjut }} |
                                                                    {{ $k->keterangan_tindak_lanjut }}</td>
                                                            </tr>
                                                        </table>
                                                        <div class="card">
                                                            <div class="card-header bg-danger">Hasil Pemeriksaan khusus
                                                            </div>
                                                            <div class="card-body">
                                                                {{ $k->pemeriksaan_khusus }} <br><br>
                                                                {{ $k->pemeriksaan_khusus_2 }}<br><br>
                                                                <img width="80%"src="{{ $k->gambar_1 }}"
                                                                    alt=""><br><br>
                                                                {{-- <img src="{{ $k->gambar_2 }}" alt=""><br><br> --}}
                                                            </div>
                                                        </div>
                                                        {{-- <button class="btn btn-info riwayattindakan mt-4"
                                        kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                        data-target="#modalriwayattindakan">Riwayat Tindakan</button> --}}
                                                        {{-- <button class="btn btn-danger hasilpemeriksaankhusus mt-4"
                                        kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                        data-target="#modalhasilpemeriksaankhusus">Hasil Pemeriksaan
                                        Khusus</button> --}}
                                                        {{-- <button class="btn btn-success riwayatupload mt-4"
                                        kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                        data-target="#modalriwayatupload">Riwayat Upload</button> --}}
                                                        {{-- <button class="btn btn-warning riwayatorder mt-4"
                                        kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                        data-target="#modalriwayatorder">Riwayat Order Penunjang</button> --}}
                                                        <table class="table table-sm table-bordered mt-4">
                                                            <thead>
                                                                <th>Tanggal assesmen</th>
                                                                <th>Nama Pemeriksa</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ $k->tgl_pemeriksaan }}</td>
                                                                    <td>
                                                                        <img src="{{ $k->signature_dokter }}"
                                                                            alt=""><br>
                                                                        <p class="text-center">{{ $k->nama_dokter }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
                    @endforeach
                </div>

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

<script>
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
        rm = $(this).attr('rm')
        counter = $(this).attr('counter')
        window.open('cetakresumeperawat/' + rm + '/' + counter);
    })
    $(".cetakresumedok").on('click', function(event) {
        rm = $(this).attr('rm')
        counter = $(this).attr('counter')
        window.open('cetakresumedokter/' + rm + '/' + counter);
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
</script>
