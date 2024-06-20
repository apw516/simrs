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
