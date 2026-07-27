<div class="card">
    <div class="card-header bg-info">Hasil Pemeriksaan Medis</div>
    <div class="card-body">
        @foreach ($assesmen_dokter as $cp)
            @if ($cp->unit_k != '1028')
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
                            <td>{{ $cp->riwayat_kehamilan_pasien_wanita }}
                                <br>
                                {{ $cp->riwyat_kelahiran_pasien_anak }}
                                <br>
                                {{ $cp->riwyat_penyakit_sekarang }}
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td>Riwayat Alergi</td>
                            <td>{{ $cp->riwayat_alergi }} |
                                {{ $cp->keterangan_alergi }} </td>
                        </tr>
                        <tr>
                            <td>Riwayat Obat yang diminum</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Kesadaran</td>
                            <td colspan="3">{{ $cp->kesadaran }}</td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan Fisik ( O )</td>
                            <td>{{ $cp->pemeriksaan_fisik }}</td>
                        </tr>
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
                            <td>Tindakan</td>
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
                            <td>Rencana Tindakan ( P )</td>
                            <td>{{ $cp->renjana_tindakan }}</td>
                        </tr>
                        <tr>
                            <td>Rencana Terapi ( P )</td>
                            <td>{{ $cp->rencanakerja }}</td>
                        </tr>
                        <tr>
                            <td>Tindak Lanjut</td>
                            <td>{{ $cp->tindak_lanjut }}<br>
                                {{ $cp->keterangan_tindak_lanjut }} <br><br>
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
                        <tr>
                            <td>Pemeriksaan Penunjang</td>
                            <td>
                                @if ($cp->kode_unit == '1012' || $cp->kode_unit == '1027')
                                    Hasil Expertisi : <br>
                                    {{ $cp->evaluasi }}
                                    <br>
                                @endif
                                <div class="card">
                                    <div class="card-header  text-bold bg-secondary">Order yang dikirim</div>
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
                            </td>
                        </tr>
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
                            <td>Hasil Pemeriksaan Khusus</td>
                            <td>
                                {{ $cp->pemeriksaan_khusus }} <br><br>
                                {{ $cp->pemeriksaan_khusus_2 }}<br><br>
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
        @else
            {{-- @if ($assesmendd[0]->signature == '')
                @if ($cp->iddokter == auth()->user()->id || $cp->iddokter == '')
                    <div class="jumbotron">
                        <h1 class="display-2 mb-3">Terima Kasih !</h1>
                        <p class="lead">Anda telah mengisi form assesmen medis rawat jalan ... </p>
                        <hr class="my-4">
                        <p>Pastikan data sudah terisi dengan benar.</p>
                        <a class="btn btn-success btn-lg" href="#" role="button"
                            onclick="simpantandatangan()">Simpan</a>
                    </div>
                @endif
            @else
                @if (count($resume_ttd) > 0)
                    <div class="alert alert-warning font-italic mt-5" role="alert">
                        Resume medis sudah ditanda tangan menggunakan tanda tangan elektronik !
                        <button class="badge btn-info btn-sm lihatberkas" idberkas="{{ $resume_ttd[0]->response }}"><i
                                class="bi bi-printer mr-1 ml-1"></i> lihat
                            berkas</button>
                        @if ($cp->iddokter == auth()->user()->id)
                            <button class="badge btn-info mr-1 ml-2 simpantandatangan" data-toggle="modal"
                                data-target="#modallogintte">Tanda Tangan Ulang</button>
                        @endif
                    </div>
                @else
                    <div class="alert alert-danger font-italic mt-5" role="alert">
                        Resume medis belum ditanda tangan menggunakan tanda tangan elektronik !
                        @if ($cp->iddokter == auth()->user()->id)
                            <button class="badge btn-info mr-1 ml-2 simpantandatangan" data-toggle="modal"
                                data-target="#modallogintte">Tanda Tangan</button>
                        @endif
                    </div>
                @endif
                <button class="btn btn-danger float-right mt-4" onclick="ambildatapasien()">Kembali</button>
            @endif --}}
            {{-- PROTEKSI UTAMA: CEK APAKAH SIGNATURE KOSONG --}}
            @if ($assesmendd[0]->signature == '')
                @if ($cp->iddokter == auth()->user()->id || empty($cp->iddokter))
                    <!-- ================================================================== -->
                    <!--  TAMPILAN 1: SUKSES ISI ASESMEN & AJAKAN SIMPAN/TTD                -->
                    <!-- ================================================================== -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4 bg-light text-center">
                        <div class="card-body p-5">
                            <!-- Ikon Centang Sukses -->
                            <div class="text-success mb-3">
                                <i class="bi bi-check-circle-fill" style="font-size: 4rem;"></i>
                            </div>

                            <h2 class="fw-bold text-dark mb-2">Terima Kasih, Dok!</h2>
                            <p class="text-secondary mx-auto mb-4 fs-5" style="max-width: 550px;">
                                Anda telah menyelesaikan pengisian <span class="fw-semibold text-primary">Formulir
                                    Asesmen Medis Rawat Jalan</span> untuk pasien ini.
                            </p>

                            <hr class="my-4 opacity-50" style="max-width: 400px; margin: 0 auto;">

                            <p class="text-muted small mb-4"><i class="bi bi-info-circle me-1"></i> Mohon pastikan
                                kembali seluruh diagnosis dan advis medis sudah terisi dengan benar.</p>

                            <!-- Tombol Aksi Utama -->
                            @if (auth()->user()->persetujuan_simpan == 1)
                                <button type="button" class="btn btn-success btn-lg px-5 py-2.5 rounded-pill shadow-xs"
                                    onclick="simpantandatangan2()">
                                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>Simpan & berikan TTE
                                </button>
                            @else
                                <button type="button" class="btn btn-success btn-lg px-5 py-2.5 rounded-pill shadow-xs"
                                    onclick="simpantandatangan2()">
                                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>Simpan </button>
                            @endif
                        </div>
                    </div>
                @endif
            @else
                <!-- ================================================================== -->
                <!--  TAMPILAN 2: STATUS VERIFIKASI TANDA TANGAN ELEKTRONIK (TTE)       -->
                <!-- ================================================================== -->
                <div class="card border-0 shadow-sm rounded-3 mb-4 bg-light text-center">
                    <div class="card-body p-5">
                        <!-- Ikon Centang Sukses -->
                        <div class="text-success mb-3">
                            <i class="bi bi-check-circle-fill" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Data assesmen berhasil disimpan !</h2>
                        <p class="text-secondary mx-auto mb-4 fs-5" style="max-width: 550px;">
                            Anda telah menyelesaikan pengisian <span class="fw-semibold text-primary">Formulir
                                Asesmen Medis Rawat Jalan</span> untuk pasien ini.
                        </p>
                        <hr class="my-4 opacity-50" style="max-width: 400px; margin: 0 auto;">
                    </div>
                </div>
                @if (count($resume_ttd) > 0)
                    <!-- STATUS: SUDAH TTE (ALERT KUNING-EMAS / SUKSES TERVERIFIKASI) -->
                    <div
                        class="card border-start border-warning border-4 shadow-sm rounded-3 mb-3 bg-warning bg-opacity-10">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap g-3">
                            <div class="d-flex align-items-center">
                                <div class="text-warning me-3">
                                    <i class="bi bi-shield-check fs-1"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Resume Medis Sudah Terverifikasi TTE</h6>
                                    <span class="text-secondary small d-block">Berkas rekam medis ini telah
                                        ditandatangani secara sah menggunakan Tanda Tangan Elektronik.</span>
                                </div>
                            </div>

                            <!-- Aksi Tombol -->
                            <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                                <button class="btn btn-outline-primary btn-sm rounded-2 lihatberkas"
                                    idberkas="{{ $resume_ttd[0]->response }}">
                                    <i class="bi bi-printer-fill me-1"></i> Lihat Berkas
                                </button>
                                @if ($cp->iddokter == auth()->user()->id)
                                    @if (auth()->user()->persetujuan_simpan == 1)
                                        <button
                                            class="btn btn-warning btn-sm rounded-2 text-dark fw-semibold simpantandatangan">
                                            <i class="bi bi-arrow-counterclockwise me-1"></i> Tanda Tangan Ulang
                                        </button>
                                    @else
                                        <div class="mt-2 mt-md-0">
                                            <button class="btn btn-warning btn-sm rounded-2 text-dark fw-semibold"
                                                data-toggle="modal" data-target="#modallogintte">
                                                <i class="bi bi-arrow-counterclockwise me-1"></i> Tanda Tangan Ulang
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <!-- STATUS: BELUM TTE (ALERT MERAH PERINGATAN) -->
                    <div
                        class="card border-start border-danger border-4 shadow-sm rounded-3 mb-3 bg-danger bg-opacity-10">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between flex-wrap g-3">
                            <div class="row">
                                {{-- status ini ditutup sementara --}}
                                {{-- <div class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <div class="text-danger me-3">
                                            <i class="bi bi-shield-exclamation fs-1"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-danger mb-1">Resume Medis Belum Ditandatangani Elektronik
                                                (TTE)</h6>
                                            <span class="text-secondary small d-block">Dokumen resume belum sah secara hukum
                                                digital sebelum DPJP membubuhkan TTE.</span>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    @if ($cp->iddokter == auth()->user()->id)
                                        @if (auth()->user()->status_tte == 0 || auth()->user()->status_tte == 'NULL' || empty(auth()->user()->status_tte))
                                            {{-- <div class="alert alert-light border-0 shadow-sm d-flex align-items-start p-3 rounded-3 mb-3 mt-4"
                                                role="alert">
                                                <div class="bg-warning-subtle text-warning rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 45px; height: 45px; min-width: 45px;">
                                                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                                </div>
                                                <div class="flex-grow-1 me-2">
                                                    <h6 class="alert-heading fw-bold text-dark mb-1"
                                                        style="font-size: 0.95rem;">
                                                        Aktivasi Tanda Tangan Elektronik (TTE) Diperlukan
                                                    </h6>
                                                    <p class="text-secondary mb-0 small lh-base">
                                                        Anda belum melakukan aktivasi akun TTE pada profil dokter Anda. Dokumen
                                                        resume medis ini
                                                        <strong class="text-danger">belum sah secara hukum digital</strong>
                                                        sebelum DPJP menyematkan sertifikat sertifikasi TTE resmi.
                                                    </p>
                                                    <a href="javascript:void(0)" id="bukaPanduanTte"
                                                        class="btn btn-sm btn-link text-warning fw-bold p-0 mt-2 text-decoration-none small">
                                                        <i class="bi bi-arrow-right-short fs-5 align-middle"></i> Panduan
                                                        Aktivasi TTE Akun Anda (klik disini ...)
                                                    </a>
                                                    <br>                                           
                                                    <a
                                                        cass="btn btn-sm btn-link text-warning fw-bold p-0 mt-2 text-decoration-none small">
                                                        <i class="bi bi-arrow-right-short fs-5 align-middle"></i> akun email <br> username : {{ auth()->user()->user_tte }}
                                                        <br> password : {{ auth()->user()->password_t }}
                                                    </a><br>
                                                     <a href="javascript:void(0)" id="loginemail"
                                                        class="btn btn-sm btn-link text-warning fw-bold p-0 mt-2 text-decoration-none small">
                                                        <i class="bi bi-arrow-right-short fs-5 align-middle"></i> Login email
                                                        cirebonkab.go.id
                                                    </a>
                                                </div>
                                            </div> --}}
                                            <div class="alert alert-light border-0 shadow-sm d-flex align-items-start p-3 rounded-3 mb-3 mt-4"
                                                role="alert">
                                                <div class="bg-warning-subtle text-warning rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 45px; height: 45px; min-width: 45px;">
                                                    <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                                                </div>
                                                <div class="flex-grow-1 me-2 w-100">
                                                    <h6 class="alert-heading fw-bold text-dark mb-1"
                                                        style="font-size: 0.95rem;">
                                                        Aktivasi Tanda Tangan Elektronik (TTE) Diperlukan
                                                    </h6>
                                                    <p class="text-secondary mb-3 small lh-base">
                                                        Anda belum mengaktifkan fitur integrasi TTE pada profil DPJP
                                                        Anda.
                                                        Dokumen rekam medis ini
                                                        <strong class="text-danger">belum sah secara hukum
                                                            digital</strong>
                                                        sebelum ditandatangani secara elektronik.
                                                    </p>
                                                    <div class="mb-3 d-flex gap-3 flex-wrap">
                                                        <a href="javascript:void(0)" id="bukaPanduanTte"
                                                            class="btn btn-sm btn-link text-warning fw-bold p-0 text-decoration-none small">
                                                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Panduan
                                                            TTE (Klik
                                                            Disini)
                                                        </a>
                                                        <a href="javascript:void(0)" id="loginemail"
                                                            class="btn btn-sm btn-link text-primary fw-bold p-0 text-decoration-none small">
                                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Webmail
                                                            Cirebonkab
                                                        </a>
                                                    </div>

                                                    <div class="bg-light rounded-3 p-2.5 mb-3 border border-light-subtle"
                                                        style="max-width: 360px;">
                                                        <small class="text-muted d-block fw-bold mb-1"
                                                            style="font-size: 0.72rem; text-uppercase: tracking-wider;">
                                                            <i class="bi bi-envelope-fill me-1"></i> Akun Email
                                                            Verifikasi
                                                            BSRE:
                                                        </small>
                                                        <div class="d-flex justify-content-between align-items-center mb-1"
                                                            style="font-size: 0.85rem;">
                                                            <span class="text-secondary">Username:</span>
                                                            <span
                                                                class="badge bg-dark-subtle text-dark font-monospace">{{ auth()->user()->user_tte }}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center"
                                                            style="font-size: 0.85rem;">
                                                            <span class="text-secondary">Password:</span>
                                                            <span
                                                                class="badge bg-dark-subtle text-dark font-monospace">{{ auth()->user()->password_t }}</span>
                                                        </div>
                                                    </div>

                                                    <hr class="border-light-subtle my-3">

                                                    <form id="formAktivasiTte" class="mt-2 formaktivasitte"
                                                        style="max-width: 450px;">
                                                        @csrf
                                                        <h6 class="fw-bold text-dark mb-2"
                                                            style="font-size: 0.85rem;"><i
                                                                class="bi bi-shield-lock-fill text-secondary me-1"></i>
                                                            Form
                                                            Aktivasi & Verifikasi DPJP</h6>
                                                        <div class="mb-2">
                                                            <label
                                                                class="form-label small text-secondary mb-1 fw-semibold">NIK
                                                                (Nomor Induk Kependudukan) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" name="nik" id="inputNik"
                                                                class="form-control form-control-sm rounded-2"
                                                                placeholder="Masukkan 16 digit NIK" required
                                                                maxlength="16">
                                                        </div>

                                                        <div class="form-check form-switch mb-2 mt-2">
                                                            <input class="form-check-input cur-pointer"
                                                                type="checkbox" role="switch" id="ingatPassphrase"
                                                                name="setuju_simpan" value="1" checked>
                                                            <label
                                                                class="form-check-label small text-dark fw-semibold cur-pointer"
                                                                voids for="ingatPassphrase">
                                                                Simpan Passphrase secara aman di sistem
                                                            </label>
                                                            <small class="text-muted d-block"
                                                                style="font-size: 0.75rem;">Jika
                                                                aktif, Anda tidak perlu mengetik PIN/Password setiap
                                                                kali
                                                                menandatangani resep/resume.</small>
                                                        </div>

                                                        <div class="mb-3" id="groupPassphrase">
                                                            <label
                                                                class="form-label small text-secondary mb-1 fw-semibold">Passphrase
                                                                / Password TTE BSRE <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="password" name="password_tte"
                                                                    id="inputPassphrase"
                                                                    class="form-control rounded-start-2"
                                                                    placeholder="Masukkan password keamanan TTE Anda">
                                                                <button class="btn btn-outline-secondary"
                                                                    type="button" id="togglePasswordSec"><i
                                                                        class="bi bi-eye-fill"></i></button>
                                                            </div>
                                                        </div>
                                                        <button type="button"
                                                            class="btn btn-warning btn-sm w-100 rounded-2 fw-bold py-2 shadow-sm text-dark"
                                                            id="btnSimpanAktivasi" onclick="simpanaktivasitte()">
                                                            <i class="bi bi-check-circle-fill me-1"></i> Verifikasi &
                                                            Aktifkan
                                                            TTE Saya
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @else
                                            @if (auth()->user()->persetujuan_simpan == 1)
                                                {{-- <div class="mt-2 mt-md-0">
                                                    <button
                                                        class="btn btn-primary btn-sm rounded-2 px-3 py-2 fw-bold shadow-sm simpantandatangan">
                                                        <i class="bi bi-shield-check-fill me-1"></i> Sematkan TTE Sekarang
                                                    </button>
                                                </div> --}}
                                                <div class="d-flex align-items-center">
                                                    <div class="text-warning me-3">
                                                        <i class="bi bi-shield-check fs-1"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">Resume Medis Sudah
                                                            Terverifikasi TTE</h6>
                                                        <span class="text-secondary small d-block">Berkas rekam medis
                                                            ini telah
                                                            ditandatangani secara sah menggunakan Tanda Tangan
                                                            Elektronik.</span>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="mt-2 mt-md-0">
                                                    <button
                                                        class="btn btn-primary btn-sm rounded-2 px-3 py-2 fw-bold shadow-sm"
                                                        data-toggle="modal" data-target="#modallogintte">
                                                        <i class="bi bi-shield-check-fill me-1"></i> Sematkan TTE
                                                        Sekarang
                                                    </button>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <!-- Aksi Tombol -->
                        </div>
                    </div>
                @endif

                <!-- Tombol Kembali yang Diletakkan di Posisi yang Tepat -->
                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-secondary px-4 shadow-xs" onclick="ambildatapasien()">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Pasien
                    </button>
                </div>
            @endif
            <!-- Style Pembantu Kelas Bootstrap 5 (Jika diperlukan fallback) -->
            <style>
                .rounded-3 {
                    border-radius: 0.5rem !important;
                }

                .shadow-xs {
                    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
                }

                .bg-warning.bg-opacity-10 {
                    background-color: rgba(255, 193, 7, 0.08) !important;
                }

                .bg-danger.bg-opacity-10 {
                    background-color: rgba(220, 53, 69, 0.08) !important;
                }

                .gap-2 {
                    gap: 0.5rem !important;
                }

                .me-2 {
                    margin-right: 0.5rem !important;
                }

                .me-3 {
                    margin-right: 1rem !important;
                }
            </style>
        @endif
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalkonsulantarpoli" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Konsul Antar Poli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formsuratkonsul">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Poli Tujuan</label>
                        <select class="form-control" id="politujuankonsul" name="politujuankonsul">
                            @foreach ($mt_unit as $u)
                                <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Dokter Pengirim</label>
                        <input readonly type="text" class="form-control" id="namadokterpengirimkonsul"
                            name="namadokterpengirimkonsul" value="{{ $mt_paramedis[0]->nama_paramedis }}">
                        <input hidden type="text" class="form-control" id="kodedokterpengirimkonsul"
                            name="kodedokterpengirimkonsul" value="{{ $mt_paramedis[0]->kode_paramedis }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Konsul</label>
                        <input type="date" class="form-control" id="tanggalkonsul" name="tanggalkonsul"
                            value="{{ $now }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Catatan Konsul</label>
                        <textarea rows="10px" type="password" class="form-control" id="catatankonsul" name="catatankonsul">
                        @if (count($assesmen_dokter) > 0)
Keluhan : {{ $assesmen_dokter[0]->keluhan_pasien }}
                        Diagnosa : {{ $assesmen_dokter[0]->diagnosakerja }}
                        Diagnosa sekunder: {{ $assesmen_dokter[0]->diagnosabanding }}
@endif
                        </textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpandatakonsul()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalrujukinternal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rujuk Internal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="formsuratrujukinternal">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Poli Tujuan</label>
                        <select class="form-control" id="namapolirujin" name="namapolirujin">
                            @foreach ($mt_unit as $u)
                                <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Dokter Pengirim</label>
                        <input readonly type="text" class="form-control" id="namadokterrujin"
                            nama="namadokterrujin" value="{{ $mt_paramedis[0]->nama_paramedis }}">
                        <input hidden type="text" class="form-control" id="kodedokterrujin"
                            name="kodedokterrujin" value="{{ $mt_paramedis[0]->kode_paramedis }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tanggal Rujuk</label>
                        <input type="date" class="form-control" id="tanggalrujin" name="tanggalrujin"
                            value="{{ $now }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Catatan Rujuk Internal</label>
                        <textarea rows="10px" type="password" class="form-control" id="catatanrujin" name="catatanrujin">
                        @if (count($assesmen_dokter) > 0)
Keluhan : {{ $assesmen_dokter[0]->keluhan_pasien }}
                        Diagnosa : {{ $assesmen_dokter[0]->diagnosakerja }}
                        Diagnosa sekunder: {{ $assesmen_dokter[0]->diagnosabanding }}
@endif
                        </textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpandatarujin()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalrujukkeluar" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rujuk Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalrujukrawatinap" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rujuk Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modallogintte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukan NIK & Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_login_tte">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIK</label>
                            <input type="email" class="form-control" id="niktte" name="niktte"
                                aria-describedby="emailHelp"
                                placeholder="Masukan nomor kartu identitas anda ( KTP ) ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="passwordtte" name="passwordtte"
                                placeholder="Masukan password tanda tangan elektronik anda ...">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="simpaninfo">
                            <label class="form-check-label" for="exampleCheck1">Simpan NIK & Password</label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpantandatangan_bsre_manual()">Simpan Tanda
                    Tangan</button>
            </div>
        </div>
    </div>
</div>
<input hidden name="kodekunjungan" id="kodekunjungan" type="text" value="{{ $kodekunjungan }}">
<script>
    function simpantandatangan2() {
        kodekunjungan = $('#kodekunjungan').val()
        Swal.fire({
            icon: 'warning',
            title: 'Anda yakin data sudah benar ?',
            text: 'Berkas akan disimpan dan ditanda tangan secara elektronik ...',
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
                    url: '<?= route('simpanttddokter2') ?>',
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
                        if (data.kode == '502') {
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
            }
        })
    }

    function simpantandatangan() {
        kodekunjungan = $('#kodekunjungan').val()
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
                        if (data.kode == '502') {
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
            }
        })
    }

    function simpantandatangan_bsre_manual() {
        kodekunjungan = $('#kodekunjungan').val()
        nik = $('#niktte').val()
        password = $('#passwordtte').val()
        simpaninfo = $('#simpaninfo:checked').val()
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
                        kodekunjungan,
                        nik,
                        password,
                        simpaninfo
                    },
                    url: '<?= route('simpantandatanganbsre_manual') ?>',
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
                            resume2()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            $('#modallogintte').modal('hide');
                            Swal.fire({
                                title: "Hasil pemeriksaan berhasil ditanda tangan ...",
                                text: "Klik cetak jika anda ingin mencetak berkas yang ditanda tangan ...",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Ya, cetak"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open('cetak_dokumen_tte/' + data.id);
                                }
                            });
                        }
                    }
                });
            }
        })

    }

    function simpantandatangan_bsre() {
        kodekunjungan = $('#kodekunjungan').val()
        nik = $('#nik').val()
        password = $('#password').val()
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
                        kodekunjungan,
                        nik,
                        password
                    },
                    url: '<?= route('simpantandatanganbsre') ?>',
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
                            resume2()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            Swal.fire({
                                title: "Hasil pemeriksaan berhasil ditanda tangan ...",
                                text: "Klik cetak jika anda ingin mencetak berkas yang ditanda tangan ...",
                                icon: "success",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Ya, cetak"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open('cetak_dokumen_tte/' + data.id);
                                }
                            });
                        }
                    }
                });
            }
        })

    }
    $(".lihatberkas").on('click', function(event) {
        id = $(this).attr('idberkas')
        window.open('cetak_dokumen_tte/' + id)
    })
    $(".simpantandatangan").on('click', function(event) {
        kodekunjungan = $('#kodekunjungan').val()
        Swal.fire({
            icon: 'warning',
            title: 'Anda yakin data sudah benar ?',
            text: 'Berkas akan disimpan dan ditanda tangan secara elektronik ...',
            showDenyButton: true,
            confirmButtonText: 'Ya',
            denyButtonText: `Cek lagi ...`,
        }).then((result) => {
            if (result.isConfirmed) {
                simpantandatangan_bsre()
            }
        })
    });
    $(".simpantandatangan2").on('click', function(event) {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            url: '<?= route('ambil_form_login_tte') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_login_tte').html(response);
            }
        });
    });

    function showmodalttd() {
        $('#modallogintte').modal('show');
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            url: '<?= route('ambil_form_login_tte') ?>',
            success: function(response) {
                spinner.hide()
                $('.v_login_tte').html(response);
            }
        });
    }
    $(document).ready(function() {
        $('#bukaPanduanTte').on('click', function(e) {
            e.preventDefault();

            // Tampilkan loader mini jika diperlukan
            let spinner = $('#loader');

            // Contoh jika Anda ingin mengambil link secara dinamis atau mencatat log via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('log.buka.panduan') }}', // Sesuaikan route jika ada, atau hapus block ajax ini jika langsung buka url
                data: {
                    _token: "{{ csrf_token() }}",
                    jenis_panduan: 'tte_dokter'
                },
                success: function(response) {
                    // Jalur URL target halaman baru
                    let urlPanduan = "{{ url('/panduan/aktivasi-tte') }}";

                    // Perintah utama membuka tab baru di browser
                    window.open(urlPanduan, '_blank', 'noopener,noreferrer');
                },
                error: function() {
                    // Backup jika ajax error, tetap buka halaman panduan
                    window.open("{{ url('/panduan/aktivasi-tte') }}", '_blank');
                }
            });
        });
        $('#loginemail').on('click', function(e) {
            e.preventDefault();
            // Tampilkan loader mini jika diperlukan
            let spinner = $('#loader');
            // Contoh jika Anda ingin mengambil link secara dinamis atau mencatat log via AJAX

            // Jalur URL target halaman baru
            let urlPanduan = "https://mail.cirebonkab.go.id/mail/";

            // Perintah utama membuka tab baru di browser
            window.open(urlPanduan, '_blank', 'noopener,noreferrer');

        });
    });

    function simpanaktivasitte() {
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
                var data = $('.formaktivasitte').serializeArray();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                        // signature
                    },
                    url: '<?= route('simpanaktivasitte') ?>',
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
                        if (data.kode == '502') {
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
            }
        })
    }
</script>
