<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/img/user.jpg') }}"
                        alt="User profile picture">
                </div>
                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} |
                    {{ $mt_pasien[0]->no_rm }}</h3>
                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-md">Diagnosa : @if (count($assesmen_dokter) > 0)
                        {{ $assesmen_dokter[0]->diagnosakerja }} <br>
                    Diagnosa Sekunder : {{ $assesmen_dokter[0]->diagnosabanding }}
                    @else
                        -
                    @endif
                <p class="text-bold text-center text-md">Nomor SEP : {{ $sep }} </p>
                {{-- @if (count($last_assdok) > 0)
                        <br>{{ $last_assdok[0]->diagnosakerja }} --}}
                </p>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">Resep Obat</div>
    <div class="card-body">
        <table class="table table-sm table-bordered">
            <thead>
                <th>Kode layanan header</th>
                <th>detail</th>
            </thead>
            <tbody>
                @foreach ($farmasi as $f)
                    <tr>
                        <td>{{ $f->kode_layanan_header }} | {{ $f->keterangan }} |</td>
                        <td>
                            <table class="table">
                                <thead>
                                    <th>Nama Barang</th>
                                    <th>Aturan</th>
                                    <th>Jumlah</th>
                                    <th>Total Layanan</th>
                                </thead>
                                <tbody>
                                    @foreach ($farmasi2 as $ff)
                                        @if ($f->id == $ff->row_id_header)
                                            <tr>
                                                <td>{{ $ff->nama_barang }} {{ $ff->NAMA_TARIF }}</td>
                                                <td>{{ $ff->jumlah_layanan }}</td>
                                                <td>{{ $ff->aturan_pakai }}</td>
                                                <td>Rp. {{ number_format($ff->total_layanan, 2) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td><button class="btn btn-info cetaknotaall" kodekunjungan="{{ $f->kode_kunjungan }}"
                                kodelayananheader="{{ $f->kode_layanan_header }}" idheader="{{ $f->id }}"><i
                                    class="bi bi-printer-fill"></i> Cetak</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">Hasil Laboratorium</div>
    <div class="card-body">
        @if (count($hasil_lab) > 0)
            <iframe src="//192.168.2.74/smartlab_waled/his/his_report?hisno={{ $hasil_lab[0]->kode_layanan_header }}"
                width="100%" height="1000px"></iframe>
        @endif
    </div>
</div>
<div class="card">
    <div class="card-header">Hasil Radiologi</div>
    <div class="card-body">
        @foreach ($hasil_rad as $r)
            <iframe
                src ="http://192.168.2.233/expertise/cetak0.php?IDs={{ $r->id_header }}&IDd={{ $r->id_detail }}&tgl_cetak={{ $date }}"
                width="100%" height="600px"></iframe>
        @endforeach
    </div>
</div>
<script>
    function cetaknota() {
        kodekunjungan = $(this).attr('kodekunjungan')
        kodelayananheader = $(this).attr('kodeheader')
        idheader = $(this).attr('idheader')
        window.open('cetaknotafarmasi_2/' + kodekunjungan + '/' + kodelayananheader + '/' + idheader);
    }
    $(".cetaknotaall").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        kodeheader = $(this).attr('kodelayananheader')
        idheader = $(this).attr('idheader')
        window.open('cetaknotafarmasi_2/' + kodekunjungan + '/' + kodeheader + '/' + idheader);
    })
</script>
