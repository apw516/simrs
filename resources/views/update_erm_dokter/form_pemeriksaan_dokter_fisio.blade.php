<div class="card">
    <div class="card-header bg-info">CPPT</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        <style>
            .alert-blink-danger {
                animation: pulse-danger 2s infinite;
            }

            .alert-blink-warning {
                animation: pulse-warning 2s infinite;
            }

            @keyframes pulse-danger {

                0%,
                100% {
                    background-color: #f8d7da;
                    box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
                }

                50% {
                    background-color: #f5b3b7;
                    box-shadow: 0 0 12px rgba(220, 53, 69, 0.4);
                }
            }

            @keyframes pulse-warning {

                0%,
                100% {
                    background-color: #fff3cd;
                }

                50% {
                    background-color: #ffe89e;
                    box-shadow: 0 0 12px rgba(255, 193, 7, 0.4);
                }
            }
        </style>
        @php
            // Menentukan class animasi berkedip secara otomatis
            $blinkClass = '';
            if (($alertClass ?? '') == 'alert-danger') {
                $blinkClass = 'alert-blink-danger';
            } elseif (($alertClass ?? '') == 'alert-warning') {
                $blinkClass = 'alert-blink-warning';
            }
        @endphp
        <div class="alert {{ $alertClass }} {{ $blinkClass }} alert-dismissible fade show p-3 mb-3 shadow-sm border-0"
            role="alert" style="{{ $borderClass }} color: #212529;">
            <div class="row align-items-top">
                <div class="col-auto pr-0 pt-1">
                    <i class="{{ $alertIcon }} fa-2x mx-2"></i>
                </div>
                <div class="col pl-3">
                    <strong class="text-uppercase font-weight-bold d-block mb-2"
                        style="letter-spacing: 1px; font-size: 0.9rem;">
                        SISTEM MONITORING PROGRAM PRB & RUJUKAN BPJS
                    </strong>
                    <p class="mb-0 font-weight-normal text-justify" style="font-size: 1.1rem; line-height: 1.5;">
                        {!! $pesan_rujukan !!}
                    </p>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                style="color: inherit; opacity: 0.6; position: absolute; top: 15px; right: 15px;">
                <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
            </button>
        </div>
        <form class="formpemeriksaan_fisio">
            <input hidden type="text" name="kodekunjungan" id="kodekunjungan" class="form-control"
                value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" id="counter" class="form-control"
                value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" id="unit" class="form-control"
                value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" id="nomorrm" class="form-control"
                value="{{ $kunjungan[0]->no_rm }}">
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Tanda - Tanda Vital</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Tekanan Darah</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tekanan darah pasien ..."
                                    aria-label="Recipient's username" id="tekanandarah" name="tekanandarah"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">mmHg</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Frekuensi nadi pasien ..."
                                    id="frekuensinadi" name="frekuensinadi" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x/menit</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Frekuensi Nafas Pasien ..."
                                    name="frekuensinafas" id="frekuensinafas" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x/menit</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Suhu</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Suhu tubuh pasien ..."
                                    aria-label="Suhu tubuh pasien" name="suhutubuh" id="suhutubuh"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">°C</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Berat Badan</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Berat badan Pasien ..."
                                    name="beratbadan" id="beratbadan" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">kg</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Umur</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Umur pasien ..."
                                    aria-label="Suhu tubuh pasien" name="usia" id="usia"
                                    aria-describedby="basic-addon2" value="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Keluhan Utama</td>
                        <td colspan="3">
                            <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ..."></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card">
                <div class="card-header text-bold bg-dark">LAYANAN FISIK DAN REHABILITASI</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Anamnesa</label>
                        <textarea type="text" class="form-control" id="anamnesa" name="anamnesa" rows="5"
                            aria-describedby="emailHelp">{{ $asesmen_terakhir ? $asesmen_terakhir->anamnesa : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Fisik dan Uji Fungsi</label>
                        <textarea type="text" class="form-control" id="pemeriksaanfisik" name="pemeriksaanfisik" rows="4">{{ $asesmen_terakhir ? $asesmen_terakhir->pemeriksaan_fisik : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis Medis ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosismedis" name="diagnosismedis"
                            rows="4" value="{{ $asesmen_terakhir ? $asesmen_terakhir->diagnosakerja : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Diagnosis fungsi ( ICD 10)</label>
                        <input type="text" class="form-control" id="diagnosisfungsi" name="diagnosisfungsi"
                            rows="4" value="{{ $asesmen_terakhir ? $asesmen_terakhir->diagnosabanding : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Pemeriksaan Penunjang</label>
                        <textarea type="text" class="form-control" id="pemeriksaanpenunjang" name="pemeriksaanpenunjang" rows="4">{{ $asesmen_terakhir ? $asesmen_terakhir->rencanakerja : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tata Laksana KFR ( ICD 9CM )</label>
                        <textarea type="text" class="form-control" id="tatalaksankfr" name="tatalaksankfr" rows="4">{{ $asesmen_terakhir ? $asesmen_terakhir->tatalaksana_kfr : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Anjuran</label>
                        <textarea type="text" class="form-control" id="anjuran" name="anjuran" rows="2">{{ $asesmen_terakhir ? $asesmen_terakhir->anjuran : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Evaluasi</label>
                        <textarea type="text" class="form-control" id="evaluasi" name="evaluasi" rows="2">{{ $asesmen_terakhir ? $asesmen_terakhir->evaluasi : '' }}</textarea>
                    </div>
                    <fieldset class="form-group row">
                        <legend class="col-form-label col-sm-4 float-sm-left pt-0">Suspek Penyakit Akibat Kerja
                        </legend>
                        <div class="col-sm-8">
                            @php
                                // Ambil nilai dari database, jika null atau kosong set default ke
                                $suspek =
                                    $asesmen_terakhir && !empty($asesmen_terakhir->riwayatlain)
                                        ? $asesmen_terakhir->riwayatlain
                                        : 'Tidak';
                            @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="supekpenyakit"
                                    id="supekpenyakit" value="Ya" {{ $suspek == 'Ya' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios1">
                                    Ya
                                </label>
                                <input type="text" class="form-control form-control-sm" id="keterangansuspek"
                                    name="keterangansuspek"
                                    value="{{ $asesmen_terakhir ? $asesmen_terakhir->ket_riwayatlain : '' }}">
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="supekpenyakit"
                                    id="supekpenyakit" value="Tidak" {{ $suspek == 'Tidak' ? 'checked' : '' }}>
                                <label class="form-check-label" for="gridRadios2">
                                    Tidak
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            {{-- <div @if ($kunjungan[0]->ref_kunjungan == '0') hidden @endif class="card">
                <div class="card-header bg-warning">Jawaban Konsul</div>
                <div class="card-body">
                    <textarea name="jawabankonsul" id="jawabankonsul" rows="10" class="form-control"></textarea>
                </div>
            </div> --}}
        </form>
        {{-- formtindaknlanjut --}}
        <form action="" class="formtindaklanjut">
            <div class="card">
                <div class="card-header bg-light">Tindak Lanjut <button type="button"
                        class="btn btn-success float-right riwayatkonsul" data-toggle="modal"
                        data-target="#modalriwayatkonsul">Riwayat Konsul</button></div>
                <div class="card-body">
                    <style>
                        .alert-blink-danger {
                            animation: pulse-danger 2s infinite;
                        }

                        .alert-blink-warning {
                            animation: pulse-warning 2s infinite;
                        }

                        @keyframes pulse-danger {

                            0%,
                            100% {
                                background-color: #f8d7da;
                                box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
                            }

                            50% {
                                background-color: #f5b3b7;
                                box-shadow: 0 0 12px rgba(220, 53, 69, 0.4);
                            }
                        }

                        @keyframes pulse-warning {

                            0%,
                            100% {
                                background-color: #fff3cd;
                            }

                            50% {
                                background-color: #ffe89e;
                                box-shadow: 0 0 12px rgba(255, 193, 7, 0.4);
                            }
                        }
                    </style>
                    @php
                        // Menentukan class animasi berkedip secara otomatis
                        $blinkClass = '';
                        if (($alertClass ?? '') == 'alert-danger') {
                            $blinkClass = 'alert-blink-danger';
                        } elseif (($alertClass ?? '') == 'alert-warning') {
                            $blinkClass = 'alert-blink-warning';
                        }
                    @endphp
                    <div class="alert {{ $alertClass }} {{ $blinkClass }} alert-dismissible fade show p-3 mb-3 shadow-sm border-0"
                        role="alert" style="{{ $borderClass }} color: #212529;">
                        <div class="row align-items-top">
                            <div class="col-auto pr-0 pt-1">
                                <i class="{{ $alertIcon }} fa-2x mx-2"></i>
                            </div>
                            <div class="col pl-3">
                                <strong class="text-uppercase font-weight-bold d-block mb-2"
                                    style="letter-spacing: 1px; font-size: 0.9rem;">
                                    SISTEM MONITORING PROGRAM PRB & RUJUKAN BPJS
                                </strong>
                                <p class="mb-0 font-weight-normal text-justify"
                                    style="font-size: 1.1rem; line-height: 1.5;">
                                    {!! $pesan_rujukan !!}
                                </p>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"
                            style="color: inherit; opacity: 0.6; position: absolute; top: 15px; right: 15px;">
                            <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                        </button>
                    </div>
                    @php
                        // Ambil nilai tindak lanjut dari database, jika null atau kosong set default ke 'PASIEN DIPULANGKAN'
                        $tindak_lanjut =
                            $asesmen_terakhir && !empty($asesmen_terakhir->tindak_lanjut)
                                ? $asesmen_terakhir->tindak_lanjut
                                : 'PASIEN DIPULANGKAN';
                    @endphp
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_konsul"
                            value="KONSUL KE POLI LAIN"
                            {{ $tindak_lanjut == 'KONSUL KE POLI LAIN' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_konsul">KONSUL KE POLI LAIN</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_kontrol"
                            value="KONTROL" {{ $tindak_lanjut == 'KONTROL' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_kontrol">KONTROL</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_rujuk_int"
                            value="RUJUK INTERNAL" {{ $tindak_lanjut == 'RUJUK INTERNAL' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_rujuk_int">RUJUK INTERNAL</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_pulang"
                            value="PASIEN DIPULANGKAN" {{ $tindak_lanjut == 'PASIEN DIPULANGKAN' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_pulang">PULANG</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_rujuk_out"
                            value="RUJUK KELUAR" {{ $tindak_lanjut == 'RUJUK KELUAR' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_rujuk_out">RUJUK KELUAR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_rawat_inap"
                            value="RUJUK RAWAT INAP" {{ $tindak_lanjut == 'RUJUK RAWAT INAP' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_rawat_inap">RAWAT INAP</label>
                    </div>
                    <div class="form-check form-check-inline mb-2">
                        <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="tl_meninggal"
                            value="PASIEN MENINGGAL" {{ $tindak_lanjut == 'PASIEN MENINGGAL' ? 'checked' : '' }}>
                        <label class="form-check-label" for="tl_meninggal">PASIEN MENINGGAL</label>
                    </div>
                    <div class="form-group mt-2">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <textarea type="text" class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut"
                            aria-describedby="emailHelp">{{ $asesmen_terakhir ? $asesmen_terakhir->keterangan_tindak_lanjut : '' }}</textarea>
                    </div>
                </div>
            </div>
        </form>
        {{-- formtindakan --}}
        <div class="card">
            <div class="card-header bg-light">Order Farmasi <button type="button"
                    class="btn btn-success float-right" data-toggle="modal" data-target="#modaltemplate"
                    onclick="ambilresep()">Template resep</button></div>
            <div class="card-body">
                <div class="form-group mt-2">
                    <button type="button" class="btn btn-success tambahobat" onclick="addform()">+ Tambah
                        Obat</button>
                </div>
                <input hidden type="text" value="" id="jumlahform">
                <form action="" method="post" class="arrayobat">
                    <div class="formobatfarmasi2">

                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="simpantemplate" onclick="showname()">
                        <label class="form-check-label" for="exampleCheck1">ceklis, untuk
                            simpan
                            resep sebagai template</label>
                    </div>
                    <input hidden type="text" class="form-control col-md-3 mb-3" id="namaresep" name="namaresep"
                        placeholder="isi nama resep ...">
                </form>
                <div class="v_itterasi_obat">

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" style="font-size:18px">Goal of treatment</label>
                    <textarea class="form-control" id="got" name="got" rows="6"
                        placeholder="Sillahkan isi disini ...."></textarea>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger float-right ml-2" onclick="batalisi()">Batal</button>
        <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalsumarilis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SUMARILIS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_sumarilis">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpenunjang_lab" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
<div class="modal fade" id="modalhasilpenunjang_rad" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
<div class="modal fade" id="modalhasilpenunjang_pa" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
<!-- Modal -->
<div class="modal fade" id="modalicare" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Icare Pasien BPJS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_icare2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="vtemplateresep">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatkonsul" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Konsul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="view_riwayat_konsul">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
<style>
    .modal-xl {
        max-width: 80%;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modalcppt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Perkembangan Pasien Terintegrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_cppt">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="hasil_lab_by_form_dokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- <div class="row">
            <div class="col-md-2">
                 <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah data</label>
                    <input type="email" class="form-control" id="jumlahdatahasil" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Masukan jumlah data yang ingin ditampilkan ...</small>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" style="margin-top:32px" onclick="tampilkanhasilnya()">Tampilkan</button>
            </div>
        </div> --}}
                <div class="v_hasil_lab_by_dokter mt-2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" id="statuslihatcppt" value="0">
<link rel="stylesheet" href="{{ asset('public/dist/css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>
<script>
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());
    });

    function simpanhasil() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Pastikan data sudah diisi dengan benar !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Simpan !"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanhasil2()
            }
        });
    }

    function tampilkanhasilnya() {
        jlh = $('#jumlahdatahasil').val()
        rm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jlh,
                rm
            },
            url: '<?= route('ambilhasillab_by_limit') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_hasil_lab_by_dokter').html(response);
                spinner.hide()
            }
        });
    }

    function simpanhasil2() {
        var datapemeriksaan = $('.formpemeriksaan_fisio').serializeArray();
        var formorder_lab = $('.formorder_lab').serializeArray();
        var formtindakan_rad = $('.formtindakan_rad').serializeArray();
        var datatindakan = $('.formtindakan').serializeArray();
        var formobat_farmasi = $('.formobat_farmasi').serializeArray();
        var formobatfarmasi2 = $('.arrayobat').serializeArray();
        var datatindaklanjut = $('.formtindaklanjut').serializeArray();
        var simpantemplate = $('#simpantemplate:checked').val()
        var namaresep = $('#namaresep').val()
        var kodekunjungan = $('#kodekunjungan').val()
        var pasieniter = $('#iterasipilih:checked').val()
        var jumlahiter = $('#jumlahiterasi').val()
        var hasilexpertisi = $('#hasilexpertisi').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(datapemeriksaan),
                datatindakan: JSON.stringify(datatindakan),
                datatindaklanjut: JSON.stringify(datatindaklanjut),
                formobat_farmasi: JSON.stringify(formobat_farmasi),
                formobatfarmasi2: JSON.stringify(formobatfarmasi2),
                simpantemplate,
                namaresep,
                kodekunjungan,
                formorder_lab: JSON.stringify(formorder_lab),
                formtindakan_rad: JSON.stringify(formtindakan_rad),
                hasilexpertisi,
                pasieniter,
                jumlahiter
            },
            url: '<?= route('simpanhasilpemeriksaandokterfisio') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    resume2()
                }
            }
        });
    }

    function ambilformiterasiobat() {
        var kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_formiterasiobat') ?>',
            success: function(response) {
                $('.v_itterasi_obat').html(response);
                spinner.hide()
            }
        });
    }

    function batalisi() {
        rm = $('#nomorrm').val()
        formcatatanmedis(rm)
    }
    $(function() {
        $("#tabeltindakan_rad").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan_rad').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_rad"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });
    $(function() {
        $("#tabeltindakan_lab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan_lab').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap_lab"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });
    $(function() {
        $("#tabeltindakan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltindakan').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                    namatindakan +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                    kode +
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                    tarif +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                    kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });

    function showname() {
        a = $('#simpantemplate:checked').val()
        if (a == 'on') {
            $('#namaresep').removeAttr('Hidden', true)
        } else {
            $('#namaresep').attr('Hidden', true)
        }
    }

    function ambilresep() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilresep') ?>',
            error: function(data) {
                alert('ok')
                spinner.hide()
            },
            success: function(response) {
                $('.vtemplateresep').html(response)
                spinner.hide()
            }
        });
    }

    function ambilriwayatresep() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilriwayatreseppasien') ?>',
            error: function(data) {
                alert('ok')
                spinner.hide()
            },
            success: function(response) {
                $('.vtemplateresep').html(response)
                spinner.hide()
            }
        });
    }
    $('#pencarianobat').on('input', function() {
        var kodekunjungan = $('#kodekunjungan').val()
        // spinner = $('#loader')
        // spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                key: $('#pencarianobat').val(),
                kodekunjungan
            },
            url: '<?= route('cariobat') ?>',
            success: function(response) {
                $('.tableobat').html(response);
                // spinner.hide()
            }
        });
    });

    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
    $(document).ready(function() {
        ambilgambar()
        ambilriwayatobat()
        ambilformiterasiobat()
    })

    function ambilriwayatobat() {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilriwayatobat') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.formobatfarmasi2').html(response)
                spinner.hide()
            }
        });
    }

    function resetgambar() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilgambarpemeriksaan_reset') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.gambar1').html(response)
            }
        });
    }

    function ambilgambar() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('ambilgambarpemeriksaan') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.gambar1').html(response)
            }
        });
    }

    function showicare2() {
        var kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_icarepasien') ?>',
            success: function(response) {
                $('.v_icare2').html(response);
                spinner.hide()
            }
        });
    }

    function addform() {
        var max_fields = 10;
        var wrapper = $(".formobatfarmasi2"); //Fields wrapper
        var x = 1
        jlh = $('#jumlahform').val()
        cek = document.getElementById('jumlahform').value
        if (cek === '') {
            jlh1 = $('#jumlahform').val(1)
        } else {
            cek = parseInt(document.getElementById('jumlahform').value)
            jlh2 = $('#jumlahform').val(cek + 1)
        }
        nomor = parseInt(document.getElementById('jumlahform').value)
        if (x < max_fields) { //max input box allowed
            nama = 'namaobat' + nomor
            aturan = 'aturanpakai' + nomor
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Obat</label><input type="" class="form-control form-control-sm text-xs" id="' +
                nama +
                '" name="namaobat" value=""><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang" value="""></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input type="" class="form-control form-control-sm" id="' +
                aturan +
                '" name="aturanpakai" value=""></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="jumlah" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Signa</label><input type="" class="form-control form-control-sm" id="" name="signa" value="0"><input hidden type="" class="form-control form-control-sm" id="" name="kode_kunjungan" value="0"></div><div class="form-group col-md-2"><label for="inputPassword4">Keterangan</label><input type="" class="form-control form-control-sm" id="" name="keterangan" value=""></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                kode = $(this).attr('kode2')
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
            // $('#'+nama).autocomplete({
            //     source: "<?= route('cariobat') ?>",
            //     select: function(event, ui) {
            //         $('[id="namaobat"]').val(ui.item.label);
            //         $('[id="'+aturan+'"]').val(ui.item.aturan);
            //     }
            // });
        }
    }
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
    $(".liathasil_lab2").click(function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('rm')
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
</script>
<script src="{{ asset('public/marker/markerjs2.js') }}"></script>
