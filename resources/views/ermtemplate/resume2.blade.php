<div class="card">
    <div class="card-header">Resume pemeriksaan rawat jalan</div>
    <div class="card-body">
        @foreach ($assesmen as $cp)
            <table class="table table-sm table-bordered">
                <tr>
                    <td>Sumber Data</td>
                    <td>{{ $cp->sumber_data }}
                    </td>
                </tr>
                <tr>
                    <td>Keluhan Utama</td>
                    <td>{{ $cp->keluhan_pasien }}</td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Dahulu</td>
                    <td>{{ $cp->riwayat_kehamilan_pasien_wanita }} <br>
                        {{ $cp->riwyat_kelahiran_pasien_anak }} <br>
                        {{ $cp->riwyat_penyakit_sekarang }} <br>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Alergi</td>
                    <td>{{ $cp->riwayat_alergi }} | {{ $cp->keterangan_alergi }} </td>
                </tr>
                <tr>
                    <td>Riwayat Obat yang diminum</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Pemeriksaan Fisik ( O )</td>
                    <td>{{ $cp->pemeriksaan_fisik }}</td>
                </tr>
                <tr>
                    <td>Diagnosis ( A )</td>
                    <td>{{ $cp->diagnosakerja }}<br>

                        Diagnosa sekunder : {{ $cp->diagnosabanding }}
                    </td>
                </tr>
                <tr>
                    <td>Rencana Terapi ( P )</td>
                    <td>{{ $cp->rencanakerja }}

                        <div class="card mt-2">
                            <div class="card-header">Order Farmasi</div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Aturan Pakai</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderfarmasi as $of )
                                            <tr>
                                                <td>{{ $of->namabarang}}</td>
                                                <td>{{ $of->jumlah}}</td>
                                                <td>{{ $of->aturanpakai}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Rencana Permeriksaan Penunjang</td>
                    <td>{{ $cp->rencanakerja }}</td>
                </tr>
                <tr>
                    <td>Tindak Lanjut</td>
                    <td>{{ $cp->tindak_lanjut }}<br>
                        {{ $cp->keterangan_tindak_lanjut }}
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Periksa</td>
                    <td>{{ $cp->tgl_pemeriksaan }}</td>
                </tr>
                <tr>
                    <td>Dokter Periksa</td>
                    <td>
                        {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                    </td>
                </tr>
            </table>
        @endforeach
    </div>
</div>
