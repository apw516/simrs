{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    {{-- <meta name="viewport" content= "width=device-width, user-scalable=no"> --}}

<title>
    cetakan
</title>
<link href='{{ asset('public/img/logo_rs.png') }}' rel='shortcut icon'>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"> --}}
<!-- overlayScrollbars -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
<style>
    /* @page {
                margin: 10px 25px;
            } */
    @page {
        /* size: 21cm 29.7cm; */
        margin: 10px, 10px;
    }

    /* main {
            height: 1100px;
            width: 100%;
            background-color: rgb(255, 255, 255);
        } */


    table,
    th,
    td {
        border: 1.2px solid black;
    }
</style>
</head>

<body id="my"
    class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    <main style="margin-bottom:220px">
        <table class="table table-sm">
            <tbody>
                <tr>
                    <td width="30%"><img width="100%" src="{{ asset('public/img/logo_rs.png') }}" alt="">
                    </td>
                    <td class="text-center text-bold text-xs" width="100%">PEMERINTAH KABUPATEN CIREBON <br>
                        RUMAH SAKIT UMUM DAERAH WALED<br>
                        <p class="text-xs">Jl.Prabu Kian Santang No.4 <br>Telp. 0231-661126 Fax.0231-664091 Cirebon<br>
                            e-mail : brsud.waled@gmail.com </p>
                    </td>
                    <td width="100%" rowspan="2">
                        <table class="table table-sm text-sm text-bold">
                            <tr>
                                <td width="40%">Nomor RM</td>
                                <td>: {{ $mt_pasien[0]->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>: {{ $mt_pasien[0]->nama_px }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>: @php echo date('d-M-Y',strtotime($mt_pasien[0]->tanggal_lahir)) @endphp</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>: @if ($mt_pasien[0]->jenis_kelamin == 'L')
                                        Laki - Laki
                                    @elseif($mt_pasien[0]->jenis_kelamin == 'P')
                                        Perempuan
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="text-bold text-center">ASSESMEN MEDIS<br> RAWAT JALAN {{ strtoupper($kunjungan[0]->nama_unit )}}</td>
                </tr>
                <tr>
                    <td colspan="3">Tanggal kunjungan : @php echo date('d-M-Y',strtotime($kunjungan[0]->tgl_masuk)) @endphp</td>
                </tr>
            </tbody>
        </table>
        @if($kunjungan[0]->kode_unit == '1028')
        <table class="table table-sm">
            <tr>
                <td colspan="4" class="text-bold">Tanda - Tanda Vital</td>
            </tr>
            <tr>
                <td width="40%" class="text-bold">Tekanan Darah</td>
                <td width="20%" >{{ $assdok[0]->tekanan_darah}} mmHg</td>
                <td class="text-bold">Frekuensi Nadi</td>
                <td>{{ $assdok[0]->frekuensi_nadi}}  x/menit </td>
            </tr>
            <tr>
                <td class="text-bold">Frekuensi Nafas</td>
                <td>{{ $assdok[0]->frekuensi_nafas}}  x/menit </td>
                <td class="text-bold">Suhu</td>
                <td>{{ $assdok[0]->suhu_tubuh}}  °C </td>
            </tr>
            <tr>
                <td class="text-bold">BB/TB/IMT </td>
                <td>{{ $assdok[0]->beratbadan}}</td>
                <td class="text-bold">Umur</td>
                <td>{{ $assdok[0]->umur}}</td>
            </tr>
            <tr>
                <td class="text-bold">Anamnesa</td>
                <td colspan="3">{{ $assdok[0]->anamnesa}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Pemeriksaan fungsi dan uji fungsi</td>
                <td colspan="3">{{ $assdok[0]->pemeriksaan_fisik}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Diagnosis Medis ( ICD 10) </td>
                <td colspan="3">{{ $assdok[0]->diagnosakerja}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Diagnosis Fungsi ( ICD 10) </td>
                <td colspan="3"{{ $assdok[0]->diagnosabanding}}></td>
            </tr>
            <tr>
                <td class="text-bold"> Pemeriksaan penunjang </td>
                <td colspan="3">{{ $assdok[0]->rencanakerja}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Anjuran</td>
                <td colspan="3">{{ $assdok[0]->anjuran}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Evaluasi </td>
                <td colspan="3">{{ $assdok[0]->evaluasi}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Suspek Penyakit akibat kerja </td>
                <td colspan="3">{{ $assdok[0]->riwayatlain}} {{ $assdok[0]->ket_riwayatlain}}</td>
            </tr>
            <tr>
                <td class="text-bold"> Tindak Lanjut </td>
                <td colspan="3">{{ $assdok[0]->tindak_lanjut}}</td>
            </tr>
            <tr>
                <td class="text-bold">Riwayat Pemakaian Obat</td>
                <td colspan="3" class="font-italic">
                    <table class="table table-sm table-bordered text-xs">
                        <thead>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Aturan Pakai</th>
                        </thead>
                        <tbody>
                            @foreach ($data_obat as $d )
                                <tr>
                                    <td>{{ $d->nama_barang}}</td>
                                    <td>{{ $d->jumlah_layanan}}</td>
                                    <td>{{ $d->aturan_pakai }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-bold">Riwayat Pemeriksaan Penunjang</td>
                <td colspan="3" class="font-italic">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <th>Nama Pemeriksaan</th>
                            <th>Unit</th>
                        </thead>
                        <tbody>
                            @foreach ($data_penunjang as $dp )
                                <tr>
                                    <td>{{ $dp->NAMA_TARIF}}</td>
                                    <td>{{ $dp->nama_unit}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-bold">Nama Dokter Pemeriksa</td>
                <td colspan="3">{{ $assdok[0]->nama_dokter }}</td>
            </tr>
        </table>
        @elseif($kunjungan[0]->kode_unit == '1026')
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td colspan="4" class="text-bold">Tanda - Tanda Vital</td>
                </tr>
                <tr>
                    <td width="40%" class="text-bold">Tekanan Darah</td>
                    <td width="20%" >{{ $assdok[0]->tekanan_darah}} mmHg</td>
                    <td class="text-bold">Frekuensi Nadi</td>
                    <td>{{ $assdok[0]->frekuensi_nadi}}  x/menit </td>
                </tr>
                <tr>
                    <td class="text-bold">Frekuensi Nafas</td>
                    <td>{{ $assdok[0]->frekuensi_nafas}}  x/menit </td>
                    <td class="text-bold">Suhu</td>
                    <td>{{ $assdok[0]->suhu_tubuh}}  °C </td>
                </tr>
                <tr>
                    <td class="text-bold">BB/TB/IMT </td>
                    <td>{{ $assdok[0]->beratbadan}}</td>
                    <td class="text-bold">Umur</td>
                    <td>{{ $assdok[0]->umur}}</td>
                </tr>
                <tr>
                    <td width="40%" class="text-bold">Sumber Data</td>
                    <td class="font-italic" colspan="3">{{ $assdok[0]->sumber_data }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Keluhan utama</td>
                    <td class="font-italic" colspan="3">{{ $assdok[0]->keluhan_pasien }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Penyakit Dahulu</td>
                    <td class="font-italic" colspan="3">{{ $assdok[0]->ket_riwayatlain }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Diagnosa WD & DD</td>
                    <td class="font-italic" colspan="3">{{ $assdok[0]->diagnosakerja }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Dasar diagnosa</td>
                    <td class="font-italic" colspan="3">{{ $assdok[0]->diagnosabanding }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-bold">ANAMNESA</td>
                </tr>
                <tr>
                    <td class="text-bold">A (ALERGI)</td>
                    <td colspan="3">{{ $assdok[0]->alergi }}</td>
                </tr>
                <tr>
                    <td class="text-bold">M (MEDIKASI)</td>
                    <td colspan="3">{{ $assdok[0]->medikasi }}</td>
                </tr>
                <tr>
                    <td class="text-bold">P (POST ILLNES)</td>
                    <td colspan="3">{{ $assdok[0]->postillnes }}</td>
                </tr>
                <tr>
                    <td class="text-bold">L (LAST MEAL)</td>
                    <td colspan="3">{{ $assdok[0]->lastmeal }}</td>
                </tr>
                <tr>
                    <td class="text-bold">E (EVENT)</td>
                    <td colspan="3">{{ $assdok[0]->event }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-bold">PEMERIKSAAN FISIK</td>
                </tr>
                <tr>
                    <td class="text-bold">COR</td>
                    <td colspan="3">{{ $assdok[0]->cor }}</td>
                </tr>
                <tr>
                    <td class="text-bold">PULMO</td>
                    <td colspan="3">{{ $assdok[0]->pulmo }}</td>
                </tr>
                <tr>
                    <td class="text-bold">GIGI</td>
                    <td colspan="3">{{ $assdok[0]->gigi }}</td>
                </tr>
                <tr>
                    <td class="text-bold">EKSTREMITAS</td>
                    <td colspan="3">{{ $assdok[0]->ekstremitas }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-bold">PENILAIAN EVALUASI JALAN NAFAS</td>
                    @php $lemon = explode('|',$assdok[0]->LEMON ) @endphp
                </tr>
                <tr>
                    <td class="text-bold">L</td>
                    <td colspan="3">{{ $lemon[0] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">E</td>
                    <td colspan="3">{{ $lemon[1] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">M</td>
                    <td colspan="3">{{ $lemon[2] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">O</td>
                    <td colspan="3">{{ $lemon[3] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">N</td>
                    <td colspan="3">{{ $lemon[4] }}</td>
                </tr>
                <tr>
                    <td class="text-bold">ASSESMEN</td>
                    <td colspan="3">{{ $assdok[0]->tindak_lanjut }}</td>
                </tr>
                <tr>
                    <td class="text-bold">SARAN</td>
                    <td colspan="3">{{ $assdok[0]->keterangan_tindak_lanjut }}</td>
                </tr>
                <tr>
                    <td class="text-bold">JAWABAN KONSUL</td>
                    <td colspan="3">{{ $assdok[0]->keterangan_tindak_lanjut_2 }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Nama Dokter Pemeriksa</td>
                    <td colspan="3">{{ $assdok[0]->nama_dokter }}</td>
                </tr>
            </tbody>
        @else
        <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td width="40%" class="text-bold">Sumber Data</td>
                    <td class="font-italic">{{ $assdok[0]->sumber_data }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Keluhan utama</td>
                    <td class="font-italic">{{ $assdok[0]->keluhan_pasien }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Penyakit Dahulu</td>
                    <td class="font-italic">{{ $assdok[0]->ket_riwayatlain }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Alergi</td>
                    <td class="font-italic">{{ $assdok[0]->riwayat_alergi }} {{ $assdok[0]->keterangan_alergi }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Pemeriksaan Fisik ( O )</td>
                    <td class="font-italic">{{ $assdok[0]->pemeriksaan_fisik }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Diagnosis ( A )</td>
                    <td class="font-italic">{{ $assdok[0]->diagnosakerja }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Diagnosis Sekunder</td>
                    <td class="font-italic">{{ $assdok[0]->diagnosabanding }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Rencana Terapi ( P )</td>
                    <td class="font-italic">{{ $assdok[0]->rencanakerja }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tindak Lanjut</td>
                    <td class="font-italic">{{ $assdok[0]->tindak_lanjut }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Pemakaian Obat</td>
                    <td class="font-italic">
                        <table class="table table-sm table-bordered text-xs">
                            <thead>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Aturan Pakai</th>
                            </thead>
                            <tbody>
                                @foreach ($data_obat as $d )
                                    <tr>
                                        <td>{{ $d->nama_barang}}</td>
                                        <td>{{ $d->jumlah_layanan}}</td>
                                        <td>{{ $d->aturan_pakai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold">Riwayat Pemeriksaan Penunjang</td>
                    <td class="font-italic">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>Nama Pemeriksaan</th>
                                <th>Unit</th>
                            </thead>
                            <tbody>
                                @foreach ($data_penunjang as $dp )
                                    <tr>
                                        <td>{{ $dp->NAMA_TARIF}}</td>
                                        <td>{{ $dp->nama_unit}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold">Nama Dokter Pemeriksa</td>
                    <td>{{ $assdok[0]->nama_dokter }}</td>
                </tr>
            </tbody>
        </table>
        @endif
        {{-- <table class="table table-sm text-xs">
            <tbody>
                <tr>
                    <td colspan="4" class="text-center text-bold bg-secondary">Tanda Tanda vital</td>
                </tr>
                <tr>
                    <td width="40%">Tekanan Darah</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->tekanandarah }} mmHg</td>
                    <td>Frekuensi Nadi</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->frekuensinadi }} x/menit</td>
                </tr>
                <tr>
                    <td>Frekuensi Nafas</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->frekuensinapas }} x/menit</td>
                    <td>Suhu</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->suhutubuh }} °C </td>
                </tr>
                <tr>
                    <td>Berat badan / Tinggi Badan / IMT</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->beratbadan }} / {{ $asskep[0]->tinggibadan }} /
                        {{ $asskep[0]->imt }}</td>
                    <td>Umur</td>
                    <td class="text-bold font-italic">{{ $asskep[0]->umur }}</td>
                </tr>
                <tr>
                    <td>Riwayat Psikologis</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->Riwayatpsikologi }}
                        {{ $asskep[0]->keterangan_riwayat_psikolog }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center text-bold bg-secondary">Status Fungsional</td>
                </tr>
                <tr>
                    <td>Penggunaan alat bantu</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->penggunaanalatbantu }}
                        {{ $asskep[0]->keterangan_alat_bantu }}</td>
                </tr>
                <tr>
                    <td>Cacat Tubuh</td>
                    <td colspan="3" class="text-bold font-italic">{{ $asskep[0]->cacattubuh }}
                        {{ $asskep[0]->keterangancacattubuh }}</td>
                </tr>
            </tbody>
        </table> --}}
    </main>
</body>

</html>
