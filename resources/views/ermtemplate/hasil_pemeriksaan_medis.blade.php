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
                                {{-- <div class="btn-group mb-4" role="group" aria-label="Basic example">
                                <button kodekunjungan="{{ $cp->id_kunjungan }}" type="button"
                                    class="btn btn-info btn-sm lihathasillab" data-toggle="modal"
                                    data-target="#modalhasillab"><i class="bi bi-eye mr-1 ml-1"></i> Hasil
                                    Laboratorium</button>
                                <button kodekunjungan="{{ $cp->id_kunjungan }}" type="button"
                                    class="btn btn-info btn-sm lihathasilrad" data-toggle="modal"
                                    data-target="#modalhasilrad"><i class="bi bi-eye mr-1 ml-1"></i> Hasil
                                    Radiologi</button>
                                <button kodekunjungan="{{ $cp->id_kunjungan }}" type="button"
                                    class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalhasilpa"><i
                                        class="bi bi-eye mr-1 ml-1"></i> Hasil Laboratorium Patologi Anatomi</button>
                            </div><br> --}}
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
                                {{-- <div class="card">
                                <div class="card-header text-bold bg-secondary">Order yang dilayani</div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead>
                                            <th>Unit</th>
                                            <th>Nama Pemeriksaan</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($penunjang as $p)
                                                @if ($p->kode_kunjungan == $cp->id_kunjungan)
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
                            </div> --}}
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
                                {{-- <div class="card">
                                                                    <div class="card-header bg-danger">Hasil Pemeriksaan khusus
                                                                    </div>
                                                                    <div class="card-body"> --}}
                                {{ $cp->pemeriksaan_khusus }} <br><br>
                                {{ $cp->pemeriksaan_khusus_2 }}<br><br>
                                <img width="80%"src="{{ $cp->gambar_1 }}" alt=""><br><br>
                                {{-- <img src="{{ $k->gambar_2 }}" alt=""><br><br> --}}
                                {{-- </div>
                                                                </div> --}}
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
            {{-- @if (count($datakonsul) > 0)
                @if ($datakonsul[0]->jenis == 'RUJIN')
                    RUJUK INTERNAL KE :
                @else
                    KONSUL KE :
                @endif {{ $datakonsul[0]->poli_konsul }} <br>
                Catatan : {{ $datakonsul[0]->catatan }}
            @endif --}}
            <br>
            <br>
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
        @else
            @if ($assesmendd[0]->signature == '')
                @if ($cp->iddokter == auth()->user()->id || $cp->iddokter == '')
                    {{-- <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button> --}}
                    <div class="jumbotron">
                        <h1 class="display-2 mb-3">Terima Kasih !</h1>
                        <p class="lead">Anda telah mengisi form assesmen medis rawat jalan ... </p>
                        {{-- <p class="lead">Tindak lanjut pasien <br>
                            {{ $resume[0]->tindak_lanjut }} | keterangan : {{ $resume[0]->keterangan_tindak_lanjut }}
                        </p> --}}
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
            @endif
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
                <h5 class="modal-title" id="exampleModalLabel">Masukan password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_login_tte">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpantandatangan_bsre()">Simpan Tanda
                    Tangan</button>
            </div>
        </div>
    </div>
</div>
<script>
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
                            $('#modallogintte').modal('toggle');
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
</script>

<input hidden name="kodekunjungan" id="kodekunjungan" type="text" value="{{ $kodekunjungan }}">
{{-- <script>
    function simpandatakonsul() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formsuratkonsul').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan
            },
            url: '<?= route('simpankonsulantarpoli') ?>',
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
                    ambilriwayatsuratrujin(kodekunjungan)
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                }
            }
        });
    }

    function simpandatarujin() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formsuratrujukinternal').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan
            },
            url: '<?= route('simpanrujukinternal') ?>',
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
                    ambilriwayatsuratrujin(kodekunjungan)
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                }
            }
        });
    }
    $(document).ready(function() {
        kodekunjungan = $('#kodekunjungan').val()
        ambilriwayatsuratrujin(kodekunjungan)
    })

    function ambilriwayatsuratrujin(kodekunjungan) {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambilriwayatsuratrujin') ?>',
            success: function(response) {
                $('.v_riwayat_surat_rujin').html(response);
                spinner.hide()
            }
        });
    }
</script> --}}
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
                            ambildatapasien()
                        }
                    }
                });
            } else if (result.isDenied) {
                resume()
            }
        })

    }
</script>
