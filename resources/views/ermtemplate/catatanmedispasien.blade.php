@php
    use Carbon\Carbon;
@endphp
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header bg-info" id="headingOnecatatan">
            <h2 class="mb-0">
                <button class="btn btn-block text-left text-light text-bold" type="button" data-toggle="collapse"
                    data-target="#collapseOnecatatan" aria-expanded="true" aria-controls="collapseOnecatatan">
                    <i class="bi bi-plus mr-1 ml-1"></i> Catatan Medis Pasien
                </button>
            </h2>
        </div>
        <div id="collapseOnecatatan" class="collapse show" aria-labelledby="headingOnecatatan"
            data-parent="#accordionExample1">
            <div class="card-body">
                @foreach ($header as $ct)
                    <div class="accordion" id="accordionExample1">
                        <div class="card">
                            <div class="card-header" id="headingOne{{ $ct->id }}">
                                <h2 class="mb-0"> <button class="btn btn-link btn-block text-left text-dark text-bold"
                                        type="button" data-toggle="collapse"
                                        data-target="#collapseOne{{ $ct->id }}" aria-expanded="true"
                                        aria-controls="collapseOne{{ $ct->id }}">
                                        {{ \Carbon\Carbon::parse($ct->tanggalkunjungan)->format('d-M-Y') }} |
                                        {{ $ct->namaunit }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne{{ $ct->id }}" class="collapse"
                                aria-labelledby="headingOne{{ $ct->id }}" data-parent="#accordionExample1">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header p-2">
                                                <ul class="nav nav-pills">
                                                    <li class="nav-item"><a class="nav-link active" href="#activity{{$ct->id}}"
                                                            data-toggle="tab"><i
                                                                class="bi bi-bookmark-plus mr-1 ml-1"></i>Assemen awal
                                                            medis</a></li>
                                                    <li class="nav-item"><a class="nav-link" href="#timeline{{ $ct->id}}"
                                                            data-toggle="tab"><i
                                                                class="bi bi-bookmark-plus mr-1 ml-1"></i>Assesmen awal
                                                            keperawatan</a></li>
                                                </ul>
                                            </div><!-- /.card-header -->
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div class="active tab-pane" id="activity{{$ct->id}}">
                                                        <table class="table table-sm table-bordered">
                                                            <tr>
                                                                <td class="text-bold font-lg">
                                                                    ASSESMEN AWAL MEDIS RAWAT JALAN <br>
                                                                </td>
                                                                <td class="font-italic text-bold">
                                                                    <div class="row">
                                                                        <div class="col-md-6">Nomor RM</div>
                                                                        <div class="col-md-4">: {{ $ct->no_rm }} </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">Nama</div>
                                                                        <div class="col-md-4">: {{ $datapasien[0]->nama_px }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">Tanggal lahir</div>
                                                                        <div class="col-md-4">: {{ $datapasien[0]->tgl_lahir }}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">Jenis Kelamin</div>
                                                                        <div class="col-md-4">:
                                                                            {{ $datapasien[0]->jenis_kelamin }}</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="bg-light text-bold">
                                                                <td>Tanggal dan jam kunjungan : {{ $ct->tanggalkunjungan }} </td>
                                                                <td>Tanggal dan jam pemeriksaan : {{ $ct->tanggalperiksa }} </td>
                                                            </tr>
                                                            @if ($ct->kode_unit == '1028')
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Tekanan Darah : {{ $ct->tekanan_darah }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Frekuensi Nadi : {{ $ct->frekuensi_nadi }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Frekuensi Nafas : {{ $ct->frekuensi_nafas }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Suhu : {{ $ct->suhu_tubuh }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Berat Badan : {{ $ct->beratbadan }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Umur : {{ $ct->umur }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Anamnesa : {{ $ct->anamnesa }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Pemeriksaan Fisik dan Uji Fungsi :
                                                                        {{ $ct->pemeriksaan_fisik }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Diagnosis Medis ( ICD 10) :
                                                                        {{ $ct->diagnosakerja }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Diagnosis Fungsi ( ICD 10) :
                                                                        {{ $ct->diagnosabanding }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Pemeriksaan Penunjang :
                                                                        {{ $ct->rencanakerja }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Tata Laksana KFR ( ICD 9CM ) :
                                                                        {{ $ct->tatalaksana_kfr }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Anjuran : {{ $ct->anjuran }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Evaluasi : {{ $ct->evaluasi }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Suspek penyakit akibat kerja :
                                                                        @if ($ct->riwayatlain == 0)
                                                                            Tidak Ada
                                                                        @else
                                                                            Ada / {{ $ct->ket_riwayatlain }}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @elseif($ct->kode_unit == '1026')
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Sumber Data :
                                                                        @if ($ct->versi == 1)
                                                                            {{ $ct->sumberdataperiksa }}
                                                                        @else
                                                                            @if ($ct->sumberdataperiksa == 1)
                                                                                Pasien Sendiri / Autoanamnese
                                                                            @elseif($ct->sumberdataperiksa == 2)
                                                                                Keluarga
                                                                            @endif
                                                                        @endif
                                                                        <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Keluhan Utama : {{ $ct->keluhan_pasien }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Diagnosa WD : {{ $ct->diagnosakerja }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Dasar Diagnosa : {{ $ct->diagnosabanding }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">ANAMNESA<br><br>
                                                                        ALERGI : {{ $ct->alergi }} <br>
                                                                        MEDIKASI : {{ $ct->medikasi }} <br>
                                                                        POSTILNNES : {{ $ct->postillnes }} <br>
                                                                        LASTMEAL {{ $ct->lastmeal }} <br>
                                                                        EVENT {{ $ct->event }} <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">PEMERIKSAAN FISIK<br><br>
                                                                        COR : {{ $ct->cor }} <br>
                                                                        GIGI : {{ $ct->gigi }} <br>
                                                                        PULMMO : {{ $ct->pulmo }} <br>
                                                                        EKSTREMITAS {{ $ct->ekstremitas }} <br>
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">PENILAIAN EVALUASI JALAN NAFAS<br>
                                                                        @php
                                                                            $lemon = explode('|', $ct->LEMON);
                                                                        @endphp
                                                                        @if (count($lemon) > 0)
                                                                            L : {{ $lemon[0] }} <br>
                                                                            E : {{ $lemon[1] }} <br>
                                                                            M : {{ $lemon[2] }} <br>
                                                                            O : {{ $lemon[3] }} <br>
                                                                            N : {{ $lemon[4] }} <br>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">ASSESMEN <br>
                                                                        @if ($ct->tindak_lanjut == 1)
                                                                            Setuju dijadwalkan untuk operasi
                                                                        @else
                                                                            Saat ini keadaan pasien dalam kondisi belum untuk
                                                                            dilakukan tindakan anestesis
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">SARAN : <br>
                                                                        {{ $ct->keterangan_tindak_lanjut }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">JAWABAN KONSUL : <br>
                                                                        {{ $ct->keterangan_tindak_lanjut_2 }}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Sumber Data :
                                                                        @if ($ct->versi == 1)
                                                                            {{ $ct->sumberdataperiksa }}
                                                                        @else
                                                                            @if ($ct->sumberdataperiksa == 1)
                                                                                Pasien Sendiri / Autoanamnese
                                                                            @elseif($ct->sumberdataperiksa == 2)
                                                                                Keluarga
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Keluhan Utama : {{ $ct->keluhan_pasien }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Riwayat Penyait Dahulu :
                                                                        {{ $ct->riwayat_kehamilan_pasien_wanita }}
                                                                        {{ $ct->riwyat_kelahiran_pasien_anak }}
                                                                        {{ $ct->riwyat_penyakit_sekarang }}
                                                                        {{ $ct->ket_riwayatlain }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Riwayat Alergi : {{ $ct->riwayat_alergi }}
                                                                        <br>
                                                                        {{ $ct->keterangan_alergi }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Riwayat Obat yang diminum :
                                                                        {{ $ct->ket_riwayatlain }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Pemeriksaan Fisik ( O ) :
                                                                        {{ $ct->pemeriksaan_fisik }} </td>
                                                                </tr>
                                                                @if ($ct->kode_unit == '1014')
                                                                    <tr class="font-italic text-bold">
                                                                        <td colspan="2">Hasil Pemeriksaan RO : <br>
                                                                            Hasil Pemeriksaan : {{ $ct->tajampenglihatandekat }}
                                                                            <br>
                                                                            MATA KIRI | MATA KANAN <br>
                                                                            Tekanan Intra Okular : {{ $ct->tekananintraokular }}
                                                                            <br>
                                                                            Catatan Pemeriksaan Lain :
                                                                            {{ $ct->catatanpemeriksaanlain }} <br>
                                                                            Palpebra : {{ $ct->palpebra }} <br>
                                                                            Konjungtiva : {{ $ct->konjungtiva }} <br>
                                                                            Kornea : {{ $ct->kornea }} <br>
                                                                            Bilik mata depan : {{ $ct->bilikmatadepan }} <br>
                                                                            pupil : {{ $ct->pupil }} <br>
                                                                            iris : {{ $ct->iris }} <br>
                                                                            lensa : {{ $ct->lensa }} <br>
                                                                            Funduskopi : {{ $ct->funduskopi }} <br>
                                                                            Status oftamologis khusus :
                                                                            {{ $ct->status_oftamologis_khusus }} <br>
                                                                            Masalah medis : {{ $ct->masalahmedis }} <br>
                                                                            Prognosis : {{ $ct->prognosis }} <br>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Diagnosis ( A ) : {{ $ct->diagnosakerja }} |  Diagnosis Sekunder : {{ $ct->diagnosabanding }}<br><br>

                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Rencana Terapi ( P ) :
                                                                        {{ $ct->rencanakerja }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Rencana Pemeriksaan Penunjang :
                                                                        {{ $ct->order_laboratorium }} </td>
                                                                </tr>
                                                            @endif
                                                            @if ($ct->kode_unit != '1026')
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">
                                                                        @if ($ct->versi == 2)
                                                                            @php
                                                                                $t = explode('|', $ct->tindak_lanjut);
                                                                            @endphp
                                                                            @if (count($t) > 0)
                                                                                Tindak Lanjut : <br>
                                                                                @if ($t[0] == 1)
                                                                                    Pulang <br>
                                                                                @endif
                                                                                @if ($t[1] == 1)
                                                                                    Kontrol <br>
                                                                                @endif
                                                                                @if ($t[2] == 1)
                                                                                    Konsul Poli lain <br>
                                                                                @endif
                                                                                @if ($t[3] == 1)
                                                                                    Rawat Inap <br>
                                                                                @endif
                                                                                @if ($t[4] == 1)
                                                                                    Rujuk Keluar <br>
                                                                                @endif
                                                                                Keterangan : {{ $ct->keterangan_tindak_lanjut }}
                                                                    </td>
                                                            @endif
                                                        @else
                                                            Tindak Lanjut : {{ $ct->tindak_lanjut }} <br>
                                                            {{ $ct->keterangan_tindak_lanjut }} </td>
                                                        @endif
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td class="font-italic text-bold" colspan="2">Obat yang diberikan :<br>
                                                                @foreach ($dataSet as $od)
                                                                @foreach($od as $ob)
                                                                @if ($ct->kode_kunjungan == $ob->kode_kunjungan)
                                                                    {{ $ob->nama_barang }} | Jumlah : {{ $ob->jumlah_layanan }} | Aturan pakai :
                                                                    {{ $ob->aturan_pakai }}<br><br>
                                                                @endif
                                                                @endforeach
                                                            @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr class="font-italic text-bold">
                                                            <td colspan="2">Nama Dokter : {{ $ct->nama_dokter }} </td>
                                                        </tr>
                                                        </table>
                                                    </div>
                                                    <div class="tab-pane" id="timeline{{ $ct->id}}">
                                                        @if ($ct->kode_unit_asskep == '1028')
                                                            <table class="table table-sm table-bordered">
                                                                <tr>
                                                                    <td class="text-bold font-lg">
                                                                        ASSESMEN AWAL KEPERAWATAN RAWAT JALAN <br>
                                                                    </td>
                                                                    <td class="text-bold font-lg font-italic">
                                                                        <div class="row">
                                                                            <div class="col-md-6">Nomor RM</div>
                                                                            <div class="col-md-4">: {{ $ct->no_rm }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Nama</div>
                                                                            <div class="col-md-4">
                                                                                :{{ $datapasien[0]->nama_px }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Tanggal lahir</div>
                                                                            <div class="col-md-4">
                                                                                :{{ $datapasien[0]->tgl_lahir }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Jenis Kelamin</div>
                                                                            <div class="col-md-4">:
                                                                                {{ $datapasien[0]->jenis_kelamin }}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-light text-bold">
                                                                    <td>Tanggal dan jam kunjungan :
                                                                        {{ $ct->tanggalkunjungan }}
                                                                    </td>
                                                                    <td>Tanggal dan jam pemeriksaan :
                                                                        {{ $ct->tanggalperiksa }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Hasil Pemeriksaan : {{ $ct->keterangan_cppt }}
                                                                        <br></br>
                                                                        {{ $ct->tindakankeperawatan }}

                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        @else
                                                            <table class="table table-sm table-bordered">
                                                                <tr>
                                                                    <td class="text-bold font-lg">
                                                                        ASSESMEN AWAL KEPERAWATAN RAWAT JALAN <br>
                                                                    </td>
                                                                    <td class="text-bold font-lg font-italic">
                                                                        <div class="row">
                                                                            <div class="col-md-6">Nomor RM</div>
                                                                            <div class="col-md-4">: {{ $ct->no_rm }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Nama</div>
                                                                            <div class="col-md-4">
                                                                                :{{ $datapasien[0]->nama_px }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Tanggal lahir</div>
                                                                            <div class="col-md-4">
                                                                                :{{ $datapasien[0]->tgl_lahir }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">Jenis Kelamin</div>
                                                                            <div class="col-md-4">:
                                                                                {{ $datapasien[0]->jenis_kelamin }}
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="bg-light text-bold">
                                                                    <td>Tanggal dan jam kunjungan :
                                                                        {{ $ct->tanggalkunjungan }}
                                                                    </td>
                                                                    <td>Tanggal dan jam pemeriksaan :
                                                                        {{ $ct->tanggalperiksa }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="font-italic text-bold">
                                                                        Sumber Data :
                                                                        @if ($ct->versi == 1)
                                                                            {{ $ct->sumberdataperiksa }}
                                                                        @else
                                                                            @if ($ct->sumberdataperiksa == 1)
                                                                                Pasien Sendiri / Autoanamnese
                                                                            @else
                                                                                Keluarga / Alloanamnesa
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="font-italic text-bold">
                                                                        Keluhan Utama :
                                                                        {{ $ct->keluhanutama }} </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"
                                                                        class="text-center bg-light text-bold">Tanda
                                                                        - Tanda Vital
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td>Tekanan darah : {{ $ct->tekanandarah }}</td>
                                                                    <td>Frekuensi nadi : {{ $ct->frekuensinadi }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td>Frekuensi nafas : {{ $ct->frekuensinapas }}</td>
                                                                    <td>Suhu : {{ $ct->suhutubuh }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td>Tinggi badan : {{ $ct->tinggibadan }}</td>
                                                                    <td>Berat badan : {{ $ct->beratbadan }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td>IMT : {{ $ct->imt }}</td>
                                                                    <td>Usia : {{ $ct->usia }} </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2" class="text-center bg-light">
                                                                        Status
                                                                        fungsional
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Penggunaan alat bantu :
                                                                        @if ($ct->versi == 1)
                                                                            {{ $ct->penggunaanalatbantu }}
                                                                        @else
                                                                            @if ($ct->penggunaanalatbantu == 1)
                                                                                Tidak Ada
                                                                            @elseif($ct->penggunaanalatbantu == 2)
                                                                                Tongkat
                                                                            @else
                                                                                Kursi Roda
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Cacat Tubuh :
                                                                        @if ($ct->versi == 1)
                                                                            {{ $ct->cacattubuh }}
                                                                        @else
                                                                            @if ($ct->cacattubuh == 1)
                                                                                Tidak Ada
                                                                            @elseif($ct->cacattubuh == 2)
                                                                                Ada
                                                                            @endif
                                                                        @endif <br>
                                                                        {{ $ct->keterangancacattubuh }}
                                                                    </td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2" class="text-center bg-light">
                                                                        Assesmen Nyeri
                                                                    </td>
                                                                </tr>
                                                                @if ($ct->usia > 3)
                                                                    <tr class="font-italic text-bold">
                                                                        <td colspan="2">Apakah pasien mengeluh nyeri
                                                                            ?
                                                                            @if ($ct->versi == 1)
                                                                                {{ $ct->Keluhannyeri }}
                                                                            @else
                                                                                @if ($ct->Keluhannyeri == 1)
                                                                                    Tidak Ada
                                                                                @elseif($ct->Keluhannyeri == 2)
                                                                                    Ada
                                                                                @endif
                                                                            @endif <br>
                                                                            {{ $ct->skalenyeripasien }}
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div class="card formanak">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode
                                                                                    FLACC
                                                                                    Scale ( Pasien 1 - 3 tahun )</div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered table-striped">
                                                                                        <thead>
                                                                                            <tr class="text-bold">
                                                                                                <td rowspan="2">
                                                                                                    Kategori</td>
                                                                                                <td colspan="3"
                                                                                                    class="text-center">
                                                                                                    Score</td>
                                                                                                <td rowspan="2">
                                                                                                    Nilai Score</td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                class="text-bold text-center">
                                                                                                <td>0</td>
                                                                                                <td>1</td>
                                                                                                <td>2</td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr
                                                                                                class="font-italic text-bold table-primary">
                                                                                                <td>Face (Wajah)</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="face"
                                                                                                            id="face"
                                                                                                            value="0"
                                                                                                            @if ($ct->face == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Tidak
                                                                                                            ada
                                                                                                            ekspresi
                                                                                                            khusus,senyum</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="face"
                                                                                                            id="face"
                                                                                                            value="1"
                                                                                                            @if ($ct->face == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Menyeringai,mengerutkan
                                                                                                            dahi,tampak
                                                                                                            tidak
                                                                                                            tertarik
                                                                                                            (kadang-kadang)</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="face"
                                                                                                            id="face"
                                                                                                            value="2"
                                                                                                            @if ($ct->face == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Dagu
                                                                                                            gemetar,gerutu
                                                                                                            berulang
                                                                                                            (sering)</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                class="font-italic text-bold ">
                                                                                                <td>Leg (Posisi Kaki)
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="leg"
                                                                                                            id="leg"
                                                                                                            value="0"
                                                                                                            @if ($ct->leg == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Posisi
                                                                                                            normal atau
                                                                                                            santai</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="leg"
                                                                                                            id="leg"
                                                                                                            value="1"
                                                                                                            @if ($ct->leg == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Gelisah,
                                                                                                            tegang</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="leg"
                                                                                                            id="leg"
                                                                                                            value="2"
                                                                                                            @if ($ct->leg == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Menendang,kaki
                                                                                                            tertekuk</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                class="font-italic text-bold table-primary">
                                                                                                <td>Activity</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Activity"
                                                                                                            id="Activity"
                                                                                                            value="0"
                                                                                                            @if ($ct->Activity == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Berbaring
                                                                                                            tenagn,posisi
                                                                                                            normal,gerakan
                                                                                                            mudah</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Activity"
                                                                                                            id="Activity"
                                                                                                            value="1"
                                                                                                            @if ($ct->Activity == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Menggeliat,
                                                                                                            tidak
                                                                                                            bisa diam,
                                                                                                            tegang</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Activity"
                                                                                                            id="Activity"
                                                                                                            value="2"
                                                                                                            @if ($ct->Activity == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Kaku
                                                                                                            atau
                                                                                                            tegang</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                class="font-italic text-bold">
                                                                                                <td>Cry (Menangis)</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="cry"
                                                                                                            id="cry"
                                                                                                            value="0"
                                                                                                            @if ($ct->Cry == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Tidak
                                                                                                            menangis</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="cry"
                                                                                                            id="cry"
                                                                                                            value="1"
                                                                                                            @if ($ct->Cry == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Merintih,
                                                                                                            merengek,
                                                                                                            kadang
                                                                                                            kadang
                                                                                                            mengeluh</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="cry"
                                                                                                            id="cry"
                                                                                                            value="2"
                                                                                                            @if ($ct->Cry == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Terus
                                                                                                            menangis
                                                                                                            atau
                                                                                                            teriak</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr
                                                                                                class="font-italic text-bold table-primary">
                                                                                                <td>Consolabity</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="consolabity"
                                                                                                            id="consolabity"
                                                                                                            value="0"
                                                                                                            @if ($ct->Consolabity == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Rileks</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="consolabity"
                                                                                                            id="consolabity"
                                                                                                            value="1"
                                                                                                            @if ($ct->Consolabity == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Dapat
                                                                                                            ditenangkan
                                                                                                            dengan
                                                                                                            sentuhan
                                                                                                            pelukan,
                                                                                                            bujukan,dialihkan</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="consolabity"
                                                                                                            id="consolabity"
                                                                                                            value="2"
                                                                                                            @if ($ct->Consolabity == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Sering
                                                                                                            mengeluh,sulit
                                                                                                            dibujuk</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card formanak">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode
                                                                                    NIPS
                                                                                    (Pasien bayi baru lahir - 30 hari)
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered">
                                                                                        <thead>
                                                                                            <th>Parameter</th>
                                                                                            <th>Nilai</th>
                                                                                            <th>Pemeriksaan fisik</th>
                                                                                            <th>Skor Pasien</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td rowspan="2">
                                                                                                    Ekspresi Wajah
                                                                                                </td>
                                                                                                <td>0</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="ekspresiwajah"
                                                                                                            id="ekspresiwajah"
                                                                                                            value="0"
                                                                                                            @if ($ct->ekspresiwajah == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Rileks</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td rowspan="2">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="ekspresiwajah"
                                                                                                            id="ekspresiwajah"
                                                                                                            value="1"
                                                                                                            @if ($ct->ekspresiwajah == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Meringgis</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td rowspan="3">
                                                                                                    Menangis</td>
                                                                                                <td>0</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Menangis"
                                                                                                            id="Menangis"
                                                                                                            value="0"
                                                                                                            @if ($ct->menangis == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Tidak
                                                                                                            menangis</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td rowspan="3">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Menangis"
                                                                                                            id="Menangis"
                                                                                                            value="1"
                                                                                                            @if ($ct->menangis == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Meringgis</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Menangis"
                                                                                                            id="Menangis"
                                                                                                            value="2"
                                                                                                            @if ($ct->menangis == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Menangis
                                                                                                            keras</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td rowspan="2">
                                                                                                    Lengan</td>
                                                                                                <td>0</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="lengan"
                                                                                                            id="lengan"
                                                                                                            value="0"
                                                                                                            @if ($ct->lengan == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Rileks</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td rowspan="2">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="lengan"
                                                                                                            id="lengan"
                                                                                                            value="1"
                                                                                                            @if ($ct->lengan == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Fleksi</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td rowspan="2">Kaki
                                                                                                </td>
                                                                                                <td>0</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Kaki"
                                                                                                            id="Kaki"
                                                                                                            value="0"
                                                                                                            @if ($ct->kaki == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Rileks</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td rowspan="2">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="Kaki"
                                                                                                            id="Kaki"
                                                                                                            value="1"
                                                                                                            @if ($ct->kaki == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Fleksi</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td rowspan="3">
                                                                                                    Keadaan
                                                                                                    terangsang
                                                                                                </td>
                                                                                                <td>0</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="keadaanterangsang"
                                                                                                            id="keadaanterangsang"
                                                                                                            value="0"
                                                                                                            @if ($ct->keadaanterangsang == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Tidur</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td rowspan="3">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="keadaanterangsang"
                                                                                                            id="keadaanterangsang"
                                                                                                            value="0"
                                                                                                            @if ($ct->keadaanterangsang == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Bangun</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="keadaanterangsang"
                                                                                                            id="keadaanterangsang"
                                                                                                            value="1"
                                                                                                            @if ($ct->keadaanterangsang == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Rewel</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td colspan="2" class="text-center bg-light">
                                                                        Assesmen
                                                                        Resiko
                                                                        Jatuh</td>
                                                                </tr>
                                                                @if ($ct->usia > 3)
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div class="card formdewasa">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode
                                                                                    Get
                                                                                    Up and Go</div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered table-striped">
                                                                                        <thead>
                                                                                            <th>FAKTOR RESIKO</th>
                                                                                            <th>SKALA</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr class="table-primary">
                                                                                                <td>a</td>
                                                                                                <td>Perhatikan cara
                                                                                                    berjalan pasien
                                                                                                    saat
                                                                                                    akan duduk dikursi,
                                                                                                    Apakah pasien
                                                                                                    tampak
                                                                                                    tidak
                                                                                                    seimbang
                                                                                                    (sempoyongan /
                                                                                                    limbung)
                                                                                                    ?
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>b</td>
                                                                                                <td>Apakah pasien
                                                                                                    memegang pinggiran
                                                                                                    kursi atau meja atau
                                                                                                    benda lain sebagai
                                                                                                    penopang
                                                                                                    saat
                                                                                                    akan duduk ?</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div class="row mt-2">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label
                                                                                                    for="exampleFormControlInput1">Hasil</label>
                                                                                                @foreach ($mt_resiko as $mr)
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="resikojatuh"
                                                                                                            id="resikojatuh"
                                                                                                            value=""
                                                                                                            @if ($mr->ID == $ct->resikojatuh) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            {{ $mr->nama }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div class="card formanak">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode
                                                                                    Humpty Dumpty</div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered table-striped">
                                                                                        <thead>
                                                                                            <th>Parameter</th>
                                                                                            <th>Faktor Risiko</th>
                                                                                            <th>Skor</th>
                                                                                            <th>Nilai Skor</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr class="table-primary">
                                                                                                <td>Umur</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="usia"
                                                                                                            id="usia"
                                                                                                            value="0"
                                                                                                            @if ($ct->umurasskep == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="usia"
                                                                                                            id="usia"
                                                                                                            value="4"
                                                                                                            @if ($ct->umurasskep == 4) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Dibawah 3
                                                                                                            tahun
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="usia"
                                                                                                            id="usia"
                                                                                                            value="3"
                                                                                                            @if ($ct->umurasskep == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            3 - 7 tahun
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="usia"
                                                                                                            id="usia"
                                                                                                            value="2"
                                                                                                            @if ($ct->umurasskep == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios3">
                                                                                                            7 - 13 tahun
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="usia"
                                                                                                            id="usia"
                                                                                                            value="1"
                                                                                                            @if ($ct->umurasskep == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios3">
                                                                                                            Lebih dari
                                                                                                            13 tahun
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Jenis Kelamin</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="jeniskelaminanak"
                                                                                                            id="jeniskelaminanak"
                                                                                                            value="0"
                                                                                                            @if ($ct->jeniskelamin == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="jeniskelaminanak"
                                                                                                            id="jeniskelaminanak"
                                                                                                            value="2"
                                                                                                            @if ($ct->jeniskelamin == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Laki - Laki
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="jeniskelaminanak"
                                                                                                            id="jeniskelaminanak"
                                                                                                            value="1"
                                                                                                            @if ($ct->jeniskelamin == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Perempuan
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr class="table-primary">
                                                                                                <td>Diagnosis</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="diagnosis"
                                                                                                            id="diagnosis"
                                                                                                            value="0"
                                                                                                            @if ($ct->diagnosis == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="diagnosis"
                                                                                                            id="diagnosis"
                                                                                                            value="4"
                                                                                                            @if ($ct->diagnosis == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Gangguan
                                                                                                            Neurologis
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="diagnosis"
                                                                                                            id="diagnosis"
                                                                                                            value="3"
                                                                                                            @if ($ct->diagnosis == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Perubahan
                                                                                                            dalam
                                                                                                            oksigenasi (
                                                                                                            masalah
                                                                                                            saluran
                                                                                                            napas,
                                                                                                            dehidrasi,
                                                                                                            anemia
                                                                                                            anorexia,sinkop,sakit
                                                                                                            kepala dll )
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="diagnosis"
                                                                                                            id="diagnosis"
                                                                                                            value="2"
                                                                                                            @if ($ct->diagnosis == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Kelainan
                                                                                                            psikis/perilaku
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="diagnosis"
                                                                                                            id="diagnosis"
                                                                                                            value="1"
                                                                                                            @if ($ct->diagnosis == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Diagnosis
                                                                                                            lainnya
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Gangguan kognitif
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="gangguankognitif"
                                                                                                            id="gangguankognitif"
                                                                                                            value="0"
                                                                                                            @if ($ct->gangguankoginitf == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="gangguankognitif"
                                                                                                            id="gangguankognitif"
                                                                                                            value="3"
                                                                                                            @if ($ct->gangguankoginitf == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Tidak
                                                                                                            menyadari
                                                                                                            keterbatan
                                                                                                            diri
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="gangguankognitif"
                                                                                                            id="gangguankognitif"
                                                                                                            value="2"
                                                                                                            @if ($ct->gangguankoginitf == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Lupa akan
                                                                                                            adanya
                                                                                                            keterbatasan
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="gangguankognitif"
                                                                                                            id="gangguankognitif"
                                                                                                            value="1"
                                                                                                            @if ($ct->gangguankoginitf == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Orientasi
                                                                                                            baik
                                                                                                            terhadap
                                                                                                            diri
                                                                                                            sendiri
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr class="table-primary">
                                                                                                <td>Faktor Lingkungan
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="faktorlingkungan"
                                                                                                            id="faktorlingkungan"
                                                                                                            value="0"
                                                                                                            @if ($ct->faktorlingkungan == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="faktorlingkungan"
                                                                                                            id="faktorlingkungan"
                                                                                                            value="4"
                                                                                                            @if ($ct->faktorlingkungan == 4) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Riwayat
                                                                                                            jatuh dari
                                                                                                            tempat
                                                                                                            tidur saat
                                                                                                            bayi / anak
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="faktorlingkungan"
                                                                                                            id="faktorlingkungan"
                                                                                                            value="3"
                                                                                                            @if ($ct->faktorlingkungan == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Pasien
                                                                                                            menggunakan
                                                                                                            alat
                                                                                                            bantu atau
                                                                                                            box/mebel
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="faktorlingkungan"
                                                                                                            id="faktorlingkungan"
                                                                                                            value="2"
                                                                                                            @if ($ct->faktorlingkungan == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Pasien
                                                                                                            diletakan
                                                                                                            ditempat
                                                                                                            tidur
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="faktorlingkungan"
                                                                                                            id="faktorlingkungan"
                                                                                                            value="1"
                                                                                                            @if ($ct->faktorlingkungan == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Diluar ruang
                                                                                                            rawat
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Respon terhadap
                                                                                                    operasi/obat
                                                                                                    penenang/efek
                                                                                                    anestesi</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="responthdop"
                                                                                                            id="responthdop"
                                                                                                            value="0"
                                                                                                            @if ($ct->responterhadapoperasi == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="responthdop"
                                                                                                            id="responthdop"
                                                                                                            value="3"
                                                                                                            @if ($ct->responterhadapoperasi == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Dalam 24 Jam
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="responthdop"
                                                                                                            id="responthdop"
                                                                                                            value="2"
                                                                                                            @if ($ct->responterhadapoperasi == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Dalam 48 Jam
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="responthdop"
                                                                                                            id="responthdop"
                                                                                                            value="1"
                                                                                                            @if ($ct->responterhadapoperasi == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            > 48 Jam
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr class="table-primary">
                                                                                                <td>Penggunaan Obat</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="penggunaanobat"
                                                                                                            id="penggunaanobat"
                                                                                                            value="0"
                                                                                                            @if ($ct->penggunaanobat == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="penggunaanobat"
                                                                                                            id="penggunaanobat"
                                                                                                            value="3"
                                                                                                            @if ($ct->penggunaanobat == 3) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            Bermacam
                                                                                                            obat yang
                                                                                                            digunakan
                                                                                                            : obat
                                                                                                            sedative
                                                                                                            (kecuali
                                                                                                            pasien
                                                                                                            icu,yang
                                                                                                            menggunakan
                                                                                                            sedasi
                                                                                                            dan
                                                                                                            paralisis),hiponotik,barbiturate,fenotiazen,antidepresan,laksatif/diuretik,narkotik
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="penggunaanobat"
                                                                                                            id="penggunaanobat"
                                                                                                            value="2"
                                                                                                            @if ($ct->penggunaanobat == 2) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Penggunaan
                                                                                                            salah satu
                                                                                                            obat
                                                                                                            diatas
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="penggunaanobat"
                                                                                                            id="penggunaanobat"
                                                                                                            value="1"
                                                                                                            @if ($ct->responterhadapoperasi == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            penggunaan
                                                                                                            obat lainnya
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td></td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td colspan="3"
                                                                                                    class="text-right">
                                                                                                    Total Skor</td>
                                                                                                <td></td>
                                                                                            </tr>
                                                                                            <tr class="table-primary">
                                                                                                <td colspan="4">
                                                                                                    Tingkat resiko<br>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="tingkatresiko"
                                                                                                            id="tingkatresiko"
                                                                                                            value="0"
                                                                                                            checked>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            -
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="tingkatresiko"
                                                                                                            id="tingkatresiko"
                                                                                                            value="1">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Skor 7 - 11
                                                                                                            risiko
                                                                                                            rendah
                                                                                                        </label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="tingkatresiko"
                                                                                                            id="tingkatresiko"
                                                                                                            value="2">
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios2">
                                                                                                            Skor >= 12
                                                                                                            risiko
                                                                                                            tinggi
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr>
                                                                    <td colspan="2" class="text-center bg-light">
                                                                        Skrinning Gizi
                                                                    </td>
                                                                </tr>
                                                                @if ($ct->usia > 3)
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div class="card formdewasa">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode Malnutrition Screening Tools
                                                                                    (Pasien
                                                                                    Dewasa)
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered">
                                                                                        <tr>
                                                                                            <td>Apakah pasien mengalamin
                                                                                                penurunan
                                                                                                berat
                                                                                                badanyang tidak
                                                                                                diinginkan dalam 6
                                                                                                bulan
                                                                                                terakhir ?
                                                                                            </td>
                                                                                            <td>Skor Pasien</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                @foreach ($mt_penurunan_bb as $bb)
                                                                                                    <div
                                                                                                        class="form-check">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahadapenuruanbb"
                                                                                                            id="apakahadapenuruanbb"
                                                                                                            value=""
                                                                                                            @if ($bb->ID == $ct->Skrininggizi) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            {{ $bb->nama }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                @foreach ($mt_skala_penurunan_bb as $MS)
                                                                                                    <div
                                                                                                        class="form-check ml-5">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="skalapenurunanbb"
                                                                                                            id="skalapenurunanbb"
                                                                                                            value=""
                                                                                                            @if ($MS->ID == $ct->beratskrininggizi) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="exampleRadios1">
                                                                                                            {{ $MS->nama }}
                                                                                                        </label>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </td>
                                                                                            <td>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">2.
                                                                                                Apakah asupan
                                                                                                makanan
                                                                                                berkurang karena
                                                                                                berkurangnya nafsu
                                                                                                makan ?
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="asupanmakananberkurang"
                                                                                                        id="asupanmakananberkurang"
                                                                                                        value="1"
                                                                                                        @if ($ct->status_asupanmkanan == 1) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="asupanmakananberkurang">
                                                                                                        TIDAK
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="asupanmakananberkurang"
                                                                                                        id="asupanmakananberkurang"
                                                                                                        value="2"
                                                                                                        @if ($ct->status_asupanmkanan == 2) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleRadios2">
                                                                                                        YA
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Total Skor</td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                3. Pasien dengan
                                                                                                diagnosa khusus :
                                                                                                Penyakit
                                                                                                DM/Ginjal/Hati/Paru/Stroke/Kanker/Penuruan
                                                                                                imunitas geriatri
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="pasiendengandiagnosakhusus"
                                                                                                        id="pasiendengandiagnosakhusus"
                                                                                                        value="1"
                                                                                                        @if ($ct->penyakitlainpasien == 1) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleRadios1">
                                                                                                        TIDAK
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="pasiendengandiagnosakhusus"
                                                                                                        id="pasiendengandiagnosakhusus"
                                                                                                        value="2"
                                                                                                        @if ($ct->penyakitlainpasien == 2) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleRadios2">
                                                                                                        YA
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        for="inputPassword"
                                                                                                        class="col-sm-2 col-form-label">Lainnya</label>
                                                                                                    <div
                                                                                                        class="col-sm-10">
                                                                                                        <textarea type="text" class="form-control" id="diagnosalainnya" name="diagnosalainnya" cols="4">{{ $ct->diagnosakhusus }}</textarea>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">Bila
                                                                                                skor lebih dari
                                                                                                atau sama dengan 2,
                                                                                                pasien beresiko
                                                                                                malnutrisi
                                                                                                dilakukan pengkajian
                                                                                                lanjut oleh
                                                                                                ahli
                                                                                                gizi</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="2">
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="resikomalnutrisi"
                                                                                                        id="resikomalnutrisi"
                                                                                                        value="2"
                                                                                                        @if ($ct->resikomalnutrisi == 2) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleRadios1">
                                                                                                        YA
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-group row">
                                                                                                    <label
                                                                                                        for="inputPassword"
                                                                                                        class="col-sm-4 col-form-label">Tanggal
                                                                                                        & jam
                                                                                                        pengkajian</label>
                                                                                                    <div
                                                                                                        class="col-sm-8">
                                                                                                        <input
                                                                                                            type="date"
                                                                                                            class="form-control"
                                                                                                            id="tanggalpengkajiangizi"
                                                                                                            name="tanggalpengkajiangizi"
                                                                                                            value="{{ $ct->tglpengkajianlanjutgizi }}">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="form-check">
                                                                                                    <input
                                                                                                        class="form-check-input"
                                                                                                        type="radio"
                                                                                                        name="resikomalnutrisi"
                                                                                                        id="resikomalnutrisi"
                                                                                                        value="1"
                                                                                                        @if ($ct->resikomalnutrisi == 1) checked @endif>
                                                                                                    <label
                                                                                                        class="form-check-label"
                                                                                                        for="exampleRadios2">
                                                                                                        TIDAK
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td colspan="2">
                                                                            <div class="card formanak">
                                                                                <div
                                                                                    class="card-header text-bold bg-light">
                                                                                    Metode
                                                                                    Strong Kids ( pasien anak - anak)
                                                                                </div>
                                                                                <div class="card-body">
                                                                                    <table
                                                                                        class="table table-sm table-bordered">
                                                                                        <thead>
                                                                                            <th>No</th>
                                                                                            <th>PERTANYAAN</th>
                                                                                            <th>-</th>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td>1</td>
                                                                                                <td>Apakah pasien tampak
                                                                                                    kurus</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahpasientampakkurus"
                                                                                                            id="apakahpasientampakkurus"
                                                                                                            value="1"
                                                                                                            @if ($ct->anaktampakkurus == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Ya</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahpasientampakkurus"
                                                                                                            id="apakahpasientampakkurus"
                                                                                                            value="0"
                                                                                                            @if ($ct->anaktampakkurus == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">Tidak</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>2</td>
                                                                                                <td width="800px">
                                                                                                    Apakah ada
                                                                                                    penurunan
                                                                                                    BB selama satu bulan
                                                                                                    terakhir
                                                                                                    (berdasarkan
                                                                                                    penilaian objektif
                                                                                                    data BB bila ada /
                                                                                                    penilaian
                                                                                                    subjektif dari orang
                                                                                                    tua pasien
                                                                                                    ATAU
                                                                                                    untuk bayi < 1 tahun
                                                                                                        : BB naik selama
                                                                                                        3 bulan terakhir
                                                                                                        )</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahadapenurunanbb"
                                                                                                            id="apakahadapenurunanbb"
                                                                                                            value="1"
                                                                                                            @if ($ct->adapenurunanbbanak == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Ya</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahadapenurunanbb"
                                                                                                            id="apakahadapenurunanbb"
                                                                                                            value="0"
                                                                                                            @if ($ct->adapenurunanbbanak == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">Tidak</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>3</td>
                                                                                                <td>Apakah terdapat
                                                                                                    salah satu dari
                                                                                                    kondisi berikut ?
                                                                                                    Diare >
                                                                                                    kali/hari
                                                                                                    dan atau muntah
                                                                                                    > 3 kali/hari dalam
                                                                                                    seminggu
                                                                                                    terakhir <br>
                                                                                                    Asupan makanan
                                                                                                    berkurang selama
                                                                                                    1
                                                                                                    minggu terakhir</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahadadiare"
                                                                                                            id="apakahadadiare"
                                                                                                            value="1"
                                                                                                            @if ($ct->anakadadiare == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Ya</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="apakahadadiare"
                                                                                                            id="apakahadadiare"
                                                                                                            value="0"
                                                                                                            @if ($ct->anakadadiare == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">Tidak</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>4</td>
                                                                                                <td>Apakah terdapat
                                                                                                    penyakit atau
                                                                                                    keadaan yang
                                                                                                    mengakibatkan
                                                                                                    pasien
                                                                                                    beresiko mengalami
                                                                                                    nutrisi</td>
                                                                                                <td>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="resikomalnutrisianak"
                                                                                                            id="resikomalnutrisianak"
                                                                                                            value="1"
                                                                                                            @if ($ct->faktormalnutrisianak == 1) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio1">Ya</label>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="form-check form-check-inline">
                                                                                                        <input
                                                                                                            class="form-check-input"
                                                                                                            type="radio"
                                                                                                            name="resikomalnutrisianak"
                                                                                                            id="resikomalnutrisianak"
                                                                                                            value="0"
                                                                                                            @if ($ct->faktormalnutrisianak == 0) checked @endif>
                                                                                                        <label
                                                                                                            class="form-check-label"
                                                                                                            for="inlineRadio2">Tidak</label>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Diagnosa Keperawatan :
                                                                        {{ $ct->diagnosakeperawatan }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Rencana Keperawatan :
                                                                        {{ $ct->rencanakeperawatan }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Tindakan Keperawatan :
                                                                        {{ $ct->tindakankeperawatan }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Evaluasi Keperawatan :
                                                                        {{ $ct->evaluasikeperawatan }}</td>
                                                                </tr>
                                                                <tr class="font-italic text-bold">
                                                                    <td colspan="2">Nama Perawat :
                                                                        {{ $ct->namapemeriksa }}</td>
                                                                </tr>
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div><!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
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
