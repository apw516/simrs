<div class="card">
    <div class="card-header bg-info">Hasil Pemeriksaan Medis</div>
    <div class="card-body">
        @foreach ($assesmen_dokter as $cp)
            @if ($cp->kode_unit != '1028')
                @if ($cp->kode_unit == '1046')
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <td>1. Lamanya nyeri ( hari / bulan / tahunan)</td>
                            <td>: {{ $cp->lamanyeri }}</td>
                        </tr>
                        <tr>
                            <td>2. Bagaimana kwalitas nyeri sekarang ?</td>
                            <td>: {{ $cp->kualitasnyeri }}</td>
                        </tr>
                        <tr>
                            <td>3. Dalam satu bulan terakhir bagaimana kwalitas nyeri ?</td>
                            <td>: {{ $cp->kualitasnyerisatubulan }}</td>
                        </tr>
                        <tr>
                            <td>4. Tandai Gambaran nyeri anda</td>
                            <td>
                                A. Tetap nyeri kadang agak meningkat
                                <input disabled readonly class="form-check-input mr-1 ml-1" type="checkbox" value="1"
                                    id="gambar1" name="gambar1" @if ($cp->gambar1 == 1) checked @endif>
                                <img width="10%" src="{{ asset('public/img/nyeri1.png') }}" alt=""
                                    class="mr-5 ml-4">
                                <br>B. Tetap nyeri kadang sangat nyeri
                                <input disabled readonly class="form-check-input mr-1 ml-1" type="checkbox"
                                    value="1" id="gambar1" name="gambar1"
                                    @if ($cp->gambar2 == 1) checked @endif>
                                <img width="10%" src="{{ asset('public/img/nyeri2.png') }}" alt=""
                                    class="mr-5 ml-4">
                                <br>C. Nyeri dengan episode tanpa nyeri
                                <input disabled readonlyclass="form-check-input mr-1 ml-1" type="checkbox"
                                    value="1" id="gambar1" name="gambar1"
                                    @if ($cp->gambar3 == 1) checked @endif>
                                <img width="10%" src="{{ asset('public/img/nyeri3.png') }}" alt=""
                                    class="mr-5 ml-4">
                                <br>D. Mendadak lebih nyeri, dengan episode nyeri diantaranya
                                <input disabled readonly class="form-check-input mr-1 ml-1" type="checkbox"
                                    value="1" id="gambar1" name="gambar1"
                                    @if ($cp->gambar4 == 1) checked @endif>
                                <img width="10%" src="{{ asset('public/img/nyeri4.png') }}" alt=""
                                    class="mr-5 ml-4">
                            </td>
                        </tr>
                        <tr>
                            <td>5. Apakah nyeri menyebar ke bagian tubuh yang lain ?</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Obat obatan</td>
                            <td>
                                <div class="card">
                                    <div class="card-header text-bold bg-secondary">Order yang dikirim dokter</div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <th>Nama Obat</th>
                                                <th>qty</th>
                                                <th>Aturan Pakai</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderfarmasi as $t)
                                                    <tr>
                                                        <td>{{ $t->kode_barang }}
                                                        </td>
                                                        <td>{{ $t->jumlah_layanan }}
                                                        </td>
                                                        <td>{{ $t->aturan_pakai }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- <div class="card">
                                <div class="card-header text-bold bg-secondary">Obat yang dilayani</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead>
                                            <th>Nama Obat</th>
                                            <th>qty</th>
                                            <th>Aturan Pakai</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($farmasi as $t)
                                                @if ($t->kode_kunjungan == $cp->id_kunjungan)
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
                            </div> --}}
                            </td>
                        </tr>
                    </table>
                @else
                    <table class="table table-sm table-bordered table-striped">
                        {{-- <tr>
                        <td>Sumber Data</td>
                        <td>{{ $cp->sumber_data }}
                        </td>
                    </tr> --}}
                        <tr>
                            <td>Keluhan Utama</td>
                            <td>{{ $cp->keluhan_pasien }}</td>
                        </tr>
                        <tr>
                            {{-- <td>Riwayat Penyakit Dahulu</td>
                        <td>{{ $cp->riwayat_kehamilan_pasien_wanita }}
                            <br>
                            {{ $cp->riwyat_kelahiran_pasien_anak }}
                            <br>
                            {{ $cp->riwyat_penyakit_sekarang }}
                            <br>
                        </td>
                    </tr> --}}
                        <tr>
                            <td>Riwayat Alergi</td>
                            <td>{{ $cp->riwayat_alergi }} |
                                {{ $cp->keterangan_alergi }} </td>
                        </tr>
                        {{-- <tr>
                        <td>Riwayat Obat yang diminum</td>
                        <td></td>
                    </tr> --}}
                        <tr>
                            <td>Kesadaran</td>
                            <td colspan="3">{{ $cp->kesadaran }}</td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan Tanda Tanda Vital</td>
                            <td> Tekanan Darah : {{ $cp->tekanan_darah }} / Frekuensi Nadi : {{ $cp->frekuensi_nadi }}
                                /
                                Frekuensi Nafas : {{ $cp->frekuensi_nafas }} / Suhu Tubuh : {{ $cp->suhu_tubuh }} <br>
                                Bb
                                / TB / IMT : {{ $cp->beratbadan }} | Umur : {{ $cp->umur }} </td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan Fisik ( O )</td>
                            <td>{{ $cp->pemeriksaan_fisik }}</td>
                        </tr>
                        <tr>
                            <td>Layanan Laboratorium</td>
                            <td>
                                @foreach ($penunjang as $pp)
                                    @if ($pp->kode_unit == 3002)
                                        {{ $pp->NAMA_TARIF }} <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Layanan Radiologi</td>
                            <td>
                                @foreach ($penunjang as $pp)
                                    @if ($pp->kode_unit == 3003)
                                        {{ $pp->NAMA_TARIF }} <br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        @if ($cp->kode_unit == '1012')
                            <tr>
                                <td>Hasil USG Kebidanan</td>
                                <td colspan="3">
                                    Hasil Expertisi : <br>
                                    {{ $cp->evaluasi }}
                                </td>
                            </tr>
                        @endif
                        @if ($cp->kode_unit == '1027')
                            <tr>
                                <td>Hasil USG Urologi</td>
                                <td colspan="3">
                                    Hasil Expertisi : <br>
                                    {{ $cp->evaluasi }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>Diagnosis ( A ) <br></td>
                        </tr>
                        <tr>
                            <td>Diagnosa Utama</td>
                            <td>{{ $cp->diagnosakerja }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa Sekunder</td>
                            <td>{{ $cp->diagnosabanding }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td>Tindakan / Prosedur</td>
                            <td>
                                {{ $cp->tindakanmedis }}<br>
                                @foreach ($tindakan as $t)
                                    @if ($t->kode_kunjungan == $cp->id_kunjungan)
                                        {{ $t->NAMA_TARIF }}<br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>Tindakan Operasi</td>
                            <td></td>
                        </tr>
                        {{-- <tr>
                        <td>Rencana Tindakan ( P )</td>
                        <td>{{ $cp->renjana_tindakan }}</td>
                    </tr>
                    <tr>
                        <td>Rencana Terapi ( P )</td>
                        <td>{{ $cp->rencanakerja }}</td>
                    </tr> --}}
                        <tr>
                            <td>Tindak Lanjut</td>
                            <td colspan="3">{{ $cp->tindak_lanjut }}<br>
                                {{ $cp->keterangan_tindak_lanjut }}
                            </td>
                        </tr>
                        {{-- <tr>
                    <td>Pemeriksaan Penunjang</td>
                    <td>{{ $cp->evaluasi }}</td>
                    </tr> --}}
                        <tr>
                            <td>Obat obatan</td>
                            <td>
                                <div class="card">
                                    <div class="card-header text-bold bg-secondary">Order yang dikirim dokter</div>
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <thead>
                                                <th>Nama Obat</th>
                                                <th>qty</th>
                                                <th>Aturan Pakai</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderfarmasi as $t)
                                                    <tr>
                                                        <td>{{ $t->kode_barang }}
                                                        </td>
                                                        <td>{{ $t->jumlah_layanan }}
                                                        </td>
                                                        <td>{{ $t->aturan_pakai }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Jawaban Konsul Ke poli lain</td>
                            <td colspan="3">{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Hasil Pemeriksaan Khusus</td>
                            <td>
                                {{ $cp->pemeriksaan_khusus }} <br><br>
                                {{ $cp->pemeriksaan_khusus_2 }}<br><br>
                                <img width="80%"src="{{ $cp->gambar_1 }}" alt=""><br><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Periksa</td>
                            <td>{{ $cp->tgl_pemeriksaan }}</td>
                        </tr>
                        <tr>
                            <td>Dokter pemeriksa</td>
                            <td>{{ $cp->nama_dokter }}</td>
                        </tr>
                    </table>
                @endif
            @else
                <table class="table table-sm">
                    <tr>
                        <td>
                            <div class="card">
                                <table class="table table-bordered table-striped font-italic">
                                    <tr>
                                        <td>Anamnesa</td>
                                        <td>: {{ $cp->anamnesa }}</td>
                                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                                        <td>: {{ $cp->pemeriksaan_fisik }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Medis ( ICD 10 )</td>
                                        <td>: {{ $cp->diagnosakerja }}</td>
                                        <input hidden id="diagnosa" type="text" value="{{ $cp->diagnosakerja }}">
                                    </tr>
                                    <tr>
                                        <td>Diagnosis Fungsi ( ICD 10 )</td>
                                        <td>: {{ $cp->diagnosabanding }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pemeriksaan Penunjang</td>
                                        <td>: {{ $cp->rencanakerja }}

                                            <br>
                                            @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                                Hasil Expertisi : <br>
                                                {{ $cp->evaluasi }}
                                                <br>
                                            @endif
                                            <div class="card">
                                                <div class="card-header text-bold bg-secondary">Terapi yang dilakukan
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
                                                                    {{-- @if ($p->kode_unit == '3009' && $p->kode_unit == '3010') --}}
                                                                    <tr>
                                                                        <td>{{ $p->nama_unit }}
                                                                        </td>
                                                                        <td>{{ $p->NAMA_TARIF }}
                                                                        </td>
                                                                    </tr>
                                                                    {{-- @endif --}}
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
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
                                            {{-- <div class="card">
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
                                            </div> --}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tata laksana KFR </td>
                                        <td>: {{ $cp->tatalaksana_kfr }}</td>
                                    </tr>
                                    <tr>
                                        <td>Anjuran </td>
                                        <td>: {{ $cp->anjuran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Evaluasi</td>
                                        <td>: {{ $cp->evaluasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Suspek Penyakit akibat kerja</td>
                                        <td>: {{ $cp->riwayatlain }}
                                            <br>
                                            ketereangan :
                                            {{ $cp->ket_riwayatlain }}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tindak Lanjut</td>
                                        <td>
                                            @if ($cp->versidk != 2)
                                                : {{ $cp->tindak_lanjut }} |
                                                {{ $cp->keterangan_tindak_lanjut }}
                                            @else
                                                @php $tinjut = explode('|',$cp->tindak_lanjut ) @endphp
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
                                            {{ $cp->keterangan_tindak_lanjut }}<br><br>

                                            @foreach ($datakonsul as $dk)
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
                                            @endforeach
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
                                                <div class="card-header text-bold bg-secondary">Order yang dikirim
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
                                                                <tr>
                                                                    <td>{{ $t->kode_barang }}
                                                                    </td>
                                                                    <td>{{ $t->jumlah_layanan }}
                                                                    </td>
                                                                    <td>{{ $t->aturan_pakai }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- <div class="card">
                                                <div class="card-header text-bold bg-secondary">Obat yang dilayani</div>
                                                <div class="card-body">
                                                    <table class="table table-sm">
                                                        <thead>
                                                            <th>Nama Obat</th>
                                                            <th>qty</th>
                                                            <th>Aturan Pakai</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($farmasi as $t)
                                                                @if ($t->kode_kunjungan == $cp->id_kunjungan)
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
                                            </div> --}}
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
                                        <td>{{ $cp->keterangan_tindak_lanjut_2 }} <br><br>
                                            @foreach ($datakonsul as $dk)
                                                @if ($dk->kode_kunjungan_2 == $cp->id_kunjungan)
                                                    @if ($dk->jenis == 'KONSUL')
                                                        KONSUL DARI POLI {{ $dk->poli_pengirim }} <br>
                                                        {{ $dk->catatan }} <br><br><br>
                                                        JAWABAN KONSUL <br>
                                                        {{ $dk->jawaban_konsul }}
                                                    @endif
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Periksa</td>
                                        <td>{{ $cp->tgl_pemeriksaan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dokter Pemeriksa</td>
                                        <td>{{ $cp->nama_dokter }}</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        {{-- <td>
                        {{ $cp->nama_dokter }} | {{ $cp->nama_unit }}
                    </td> --}}
                    </tr>
                </table>
            @endif
        @endforeach
        @if (count($assesmendd) == 0)
            <br>
            <br>
            <br>
            Dokter Belum mengisi hasil pemeriksaan ... <br><br>
            <br>
            <br>
            <div class="v_riwayat_surat_rujin">

            </div>
        @else
            {{-- @if ($cp->signature == '')
                @if ($cp->iddokter == auth()->user()->id || $cp->iddokter == '')
                    <div class="card border-0 shadow-sm text-center py-4 bg-light mt-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-2">Asesmen Medis Selesai Terisi!</h3>
                            <p class="text-secondary mx-auto" style="max-width: 500px;">
                                Anda telah mengisi form assesmen medis rawat jalan. Pastikan seluruh diagnosis klinis
                                dan instruksi medis sudah terinput dengan benar sebelum mengunci data.
                            </p>
                            <hr class="my-4 mx-auto border-secondary-subtle" style="max-width: 250px;">
                            <button type="button" class="btn btn-success btn-lg px-5 shadow-sm"
                                onclick="simpantandatangan()">
                                <i class="bi bi-pencil-square me-2"></i> Kunci & Simpan Tanda Tangan
                            </button>
                        </div>
                    </div>
                @endif
            @else
                @if ($cp->iddokter == auth()->user()->id)
                    @if ($cektte)
                        <div class="mt-4 alert alert-success border-0 shadow-sm d-flex align-items-center p-3 mb-3"
                            role="alert">
                            <i class="bi bi-shield-check fs-3 me-3 text-dark"></i>
                            <div>
                                <h6 class="alert-heading fw-bold mb-1 text-dark">Dokumen Terverifikasi</h6>
                                <p class="mb-0 text-dark fs-7">Data rekam medis telah divalidasi penuh dan
                                    ditandatangani
                                    secara elektronik (TTE) sah oleh DPJP.</p>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-outline-dark px-3 ms-3 mt-4 btn-danger text-light"
                            onclick="ambildatapasien()">
                            <i class="bi bi-arrow-left-short"></i> Kembali
                        </button>
                    @else
                        <div class="mt-4 alert alert-success border-0 shadow-sm d-flex align-items-center p-3 mb-3"
                            role="alert">
                            <i class="bi bi-shield-check fs-3 me-3 text-dark"></i>
                            <div>
                                <h6 class="alert-heading fw-bold mb-1 text-dark">Dokumen Sudah divalidasi namu belum di
                                    tanda tangan secara elektronik ...</h6>
                                <p class="mb-0 text-dark fs-7">Data rekam medis telah divalidasi penuh dan
                                    ditandatangani
                                    secara elektronik (TTE) sah oleh DPJP.</p>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-lg px-5 shadow-sm"
                            onclick="simpantandatangan()">
                            <i class="bi bi-pencil-square me-2"></i> Kunci & Simpan Tanda Tangan
                        </button>
                    @endif
                @else
                    <button class="btn btn-sm btn-outline-dark px-3 ms-3 mt-4 btn-danger text-light"
                        onclick="ambildatapasien()">
                        <i class="bi bi-arrow-left-short"></i> Kembali
                    </button>
                @endif
            @endif --}}
            @if ($cp->signature == '')
                @if ($cp->iddokter == auth()->user()->id || $cp->iddokter == '')
                    <!-- CARD: ASESMEN SELESAI TERISI -->
                    <div class="card border-0 shadow-sm text-center py-4 bg-light mt-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <!-- Menggunakan text-success dan ukuran font standar inline -->
                                <i class="bi bi-check-circle-fill text-success" style="font-size: 3.5rem;"></i>
                            </div>
                            <h3 class="font-weight-bold text-dark mb-2">Asesmen Medis Selesai Terisi!</h3>
                            <p class="text-muted mx-auto mb-4"
                                style="max-width: 500px; font-size: 0.95rem; line-height: 1.6;">
                                Anda telah mengisi form asesmen medis rawat jalan. Pastikan seluruh diagnosis klinis
                                dan instruksi medis sudah terinput dengan benar sebelum mengunci data.
                            </p>
                            <hr class="my-4 mx-auto border-light" style="max-width: 250px;">
                            <button type="button" class="btn btn-success btn-lg px-5 shadow-sm font-weight-bold"
                                onclick="simpantandatangan()">
                                <i class="bi bi-pencil-square mr-2"></i> Kunci & Simpan Tanda Tangan
                            </button>
                        </div>
                    </div>
                @endif
            @else
                @if ($cp->iddokter == auth()->user()->id)
                    @if ($cektte)
                        <!-- ALERT: DOKUMEN TERVERIFIKASI -->
                        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center p-3 mt-4"
                            role="alert">
                            <div class="mr-3 text-light" style="font-size: 2.2rem; line-height: 1;">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading font-weight-bold mb-1 text-light" style="font-size: 1.1rem;">
                                    Dokumen Terverifikasi</h5>
                                <p class="mb-0 text-light" style="font-size: 0.875rem;">
                                    Data rekam medis telah divalidasi penuh dan ditandatangani secara elektronik (TTE)
                                    sah oleh DPJP.
                                </p>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-danger text-light px-3 mt-3 shadow-sm"
                            onclick="ambildatapasien()">
                            <i class="bi bi-arrow-left-short"></i> Kembali
                        </button>
                    @else
                        <!-- ALERT: BELUM TANDA TANGAN (WARNA WARNING/ORANGE BIASANYA LEBIH COCOK) -->
                        <div class="alert alert-warning border-0 shadow-sm d-flex align-items-center p-3 mt-4"
                            role="alert">
                            <div class="mr-3 text-dark" style="font-size: 2.2rem; line-height: 1;">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading font-weight-bold mb-1 text-dark"
                                    style="font-size: 1.1rem;">Belum Ditandatangani</h5>
                                <p class="mb-0 text-dark" style="font-size: 0.875rem;">
                                    Data rekam medis telah divalidasi namun <strong>belum ditandatangani</strong> secara
                                    elektronik. Silakan lakukan penandatanganan segera.
                                </p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-success btn-lg px-5 shadow-sm font-weight-bold"
                                onclick="simpantandatangan()">
                                <i class="bi bi-pencil-square mr-2"></i> Kunci & Simpan Tanda Tangan
                            </button>
                        </div>
                    @endif
                @else
                    <!-- TOMBOL KEMBALI JIKA BUKAN DOKTER YANG BERSANGKUTAN -->
                    <button class="btn btn-sm btn-danger text-light px-3 mt-4 shadow-sm" onclick="ambildatapasien()">
                        <i class="bi bi-arrow-left-short"></i> Kembali
                    </button>
                @endif
            @endif
        @endif
    </div>
</div>

<input hidden name="kodekunjungan" id="kodekunjungan" type="text" value="{{ $kodekunjungan }}">

<script>
    function simpantandatangan() {
        kodekunjungan = $('#kodekunjungan').val()
        // var canvas = document.getElementById("the_canvas");
        // var dataUrl = canvas.toDataURL();
        // if (dataUrl ==
        //     'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
        // ) {
        //     dataUrl = ''
        // }
        // document.getElementById("signature").value = dataUrl;
        // signature = $('#signature').val()
        Swal.fire({
            icon: 'warning',
            title: 'Anda yakin data sudah benar ?',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Cek lagi ...`,
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan: kodekunjungan,
                        // signature
                    },
                    url: '<?= route('simpanttddokter') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                            footer: 'ermwaled2023'
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == '500') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops',
                                text: data.message,
                                footer: 'ermwaled2023'
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: 'ermwaled2023'
                            })
                            resume2()
                        }
                    }
                });
            } else if (result.isDenied) {
                resume()
            }
        })

    }
</script>
