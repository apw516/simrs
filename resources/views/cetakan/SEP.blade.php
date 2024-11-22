@php
    use Carbon\Carbon;
@endphp
<div class="scaled-content">
    <table style="font-size: 12px; margin-top:50px; width:100%;">
        <tr>
            <td colspan="2" style="padding-left:50px;">
                <table>
                    <td>
                        <img src="{{ asset('public/img/logobpjs.png') }}" style="height:100px; padding-right:0px;">
                    </td>
                    <td><span style="font-size: 12px; padding-left:10px; padding-bottom:0px;font-weight:bold">SURAT
                            ELEGIBILITAS PESERTA
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RSUD WALED KAB CIREBON</span></td>
                    <td>
                        <img src="{{ asset('public/img/logo_rs.png') }}"
                            style="height:70px; padding-right:0px; margin-top:10px;margin-left:160px">
                    </td>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left:50px; width:60%;">
                <table cellspacing="0" cellpadding="5" style="width:100%">
                    <tr style="font-weight: bold;font-size: 18px">
                        <td>No. SEP</td>
                        <td>: {{ $sep->response->noSep }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tgl. SEP</td>
                        <td>: {{ \Carbon\Carbon::parse($sep->response->tglSep)->format('d-m-Y') }}</td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>No. Kartu</td>
                        <td>: {{ $sep->response->peserta->noKartu }} ( {{ $sep->response->peserta->noMr }} )</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Nama Peserta</td>
                        <td>: {{ $sep->response->peserta->nama }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Tgl. Lahir</td>
                        <td>: {{ \Carbon\Carbon::parse($sep->response->peserta->tglLahir)->format('d-m-Y') }}
                            &nbsp;&nbsp;</td>
                        <td>

                            Jenis Kelamin :
                            {{ $sep->response->peserta->kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                        </td>
                    </tr>
                    <tr>
                        <td>No. Telepon</td>
                        <td>: {{ $peserta->response->peserta->mr->noTelepon }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>: {{ $sep->response->kontrol->nmDokter }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Poli Tujuan</td>
                        <td>: {{ $sep->response->poli }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Faskes Perujuk</td>
                        <td>: {{ $peserta->response->peserta->provUmum->nmProvider }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Awal</td>
                        <td>: {{ $sep->response->diagnosa }}</td>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td style="width:40%;">
                <table cellspacing="0" cellpadding="5" style="width:60%">
                    <tr>
                        <td>Peserta</td>
                        <td>: {{ $sep->response->peserta->jnsPeserta }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Jns. Rawat</td>
                        <td>: {{ $sep->response->jnsPelayanan }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Kls. Rawat</td>
                        <td>: {{ $sep->response->kelasRawat }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Penjamin</td>
                        <td>:</td>
                        <td>{{ $sep->response->penjamin }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left:50px; width:60%;">
                <table style="font-size: 7px; ">
                    <tr>
                        <td colspan="2">*Saya menyetujui BPJS Kesehatan untuk :</td>
                    </tr>
                    <tr>
                        <td style="width:4px;">a. </td>
                        <td>membuka dan atau menggunakan informasi medis Pasien untuk keperluan administrasi, pembayaran
                            asuransi atau jaminan pembiayaan kesehatan</td>
                    </tr>
                    <tr>
                        <td>b. </td>
                        <td>memberikan akses informasi medis atau riwayat pelayanan kepada dokter/tenaga medis pada RSUD
                            WALED untuk kepentingan pemeliharaan kesehatan, pengobatan, penyembuhan, dan perawatan
                            pasien.</td>
                    </tr>
                    <tr>
                        <td colspan="2">*Saya mengetahui dan memahami :</td>
                    </tr>
                    <tr>
                        <td>a. </td>
                        <td>Rumah Sakit dapat melakukan koordinasi dengan PT Jasa Raharja / PT Taspen / PT ASABRI / BPJS
                            Ketenagakerjaan atau Penjamin lainnya, jika Peserta merupakan pasien yang mengalami
                            kecelakaan lalulintas dan / atau kecelakaan kerja.</td>
                    </tr>
                    <tr>
                        <td>b. </td>
                        <td>SEP bukan sebagai bukti penjamin peserta.</td>
                    </tr>
                </table>
            </td>
            <td style="width:40%;">
                <table style="font-size: 12px; width:60%">
                    <tr>
                        <td colspan="2" style="text-align: center; ">Persetujuan <br>Pasien/Keluarga Pasien <br>
                            <img
                                src="data:image/png;base64, {{ base64_encode(QrCode::generate($sep->response->peserta->noKartu)) }} ">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center; padding-top:10px; font-size: 8px;">Waktu:
                            {{ $now }} WIB</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<style>
    @page {
        margin: 0px;
        size: 10.5cm 16cm;
        size: portrait;
    }

    body {
        margin: 3px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
    }

    .scaled-content {
        transform: scale(0.85);
        transform-origin: 0 0;
        /* Ensure scaling starts from the top-left */
        width: 117.65%;
        /* Adjust width to compensate for scaling */
    }
</style>
