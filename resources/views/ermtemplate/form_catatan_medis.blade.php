<div class="card">
    <div class="card-header bg-info">Catatan Medis Pasien</div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            @foreach ($kunjungan as $k)
                <div class="card">
                    <div class="card-header bg-success" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left text-light text-bold" type="button"
                                data-toggle="collapse" data-target="#collapse{{ $k->counter }}" aria-expanded="true"
                                aria-controls="collapseOne">
                                Kunjungan Ke - {{ $k->counter }} | {{ $k->nama_unit }} <p class="float-right">
                                    {{ $k->tgl_masuk }}</p>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{ $k->counter }}" class="collapse" aria-labelledby="headingOne"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-info mb-2 float-right cetakresume" kodekunjungan="{{ $k->id_kunjungan }}"><i class="bi bi-printer"></i>
                                        Print</button>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-warning text-bold">Assesmen awal Keperawatan</div>
                                        @if ($k->id_1 != null)
                                            <div class="container">
                                                <table class="table table-sm text-sm">
                                                    <tr>
                                                        <td class="text-bold font-italic">Sumber Data</td>
                                                        <td>{{ $k->sumber_data }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Keluhan Utama</td>
                                                        <td>{{ $k->keluhan_perawat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Tekanan Darah</td>
                                                        <td>{{ $k->tekanandarah }} mmHg</td>
                                                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                                                        <td>{{ $k->frekuensinadi }} x/menit</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                                                        <td>{{ $k->frekuensinapas }} x/menit</td>
                                                        <td class="text-bold font-italic">Suhu</td>
                                                        <td>{{ $k->suhutubuh }} °C</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Riwayat Psikologis</td>
                                                        <td>{{ $k->Riwayatpsikologi }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->keterangan_riwayat_psikolog }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="bg-warning text-bold">Status
                                                            Fungsional</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                                                        <td>{{ $k->penggunaanalatbantu }}</td>
                                                        <td class="text-bold font-italic">Keterangan Alat Bantu</td>
                                                        <td>{{ $k->keterangan_alat_bantu }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Cacat Tubuh</td>
                                                        <td>{{ $k->cacattubuh }}</td>
                                                        <td class="text-bold font-italic">Keterangan Cacat Tubuh</td>
                                                        <td>{{ $k->keterangancacattubuh }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="bg-warning text-bold">Assesmen Nyeri
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Keluhan Nyeri</td>
                                                        <td>{{ $k->Keluhannyeri }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->skalenyeripasien }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Cacat Tubuh</td>
                                                        <td>{{ $k->cacattubuh }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->keterangancacattubuh }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-warning">Assesmen resiko
                                                            jatuh</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Resiko Jatuh</td>
                                                        <td>{{ $k->resikojatuh }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-warning">Skrinning Gizi
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>1. Apakah pasien mengalami penurunan berat badan yang tidak
                                                            diinginkan dalam 6 bulan terakhir ? </td>
                                                        <td>{{ $k->Skrininggizi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan </td>
                                                        <td>{{ $k->beratskrininggizi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2. Apakah asupan makanan berkurang karena berkurangnya nafsu
                                                            makan</td>
                                                        <td>{{ $k->status_asupanmkanan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>3. Pasien dengan diagnosa khusus : Penyakit DM / Ginjal /
                                                            Hati / Paru / Stroke / Kanker / Penurunan imunitas geriatri,
                                                            lain lain...</td>
                                                        <td>{{ $k->diagnosakhusus }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan </td>
                                                        <td>{{ $k->penyakitlainpasien }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>4. Bila skor >= 2, pasien beresiko malnutrisi dilakukan
                                                            pengkajian lanjut oleh ahli gizi</td>
                                                        <td>{{ $k->resikomalnutrisi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keterangan </td>
                                                        <td>{{ $k->tglpengkajianlanjutgizi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Diagnosa Keperawatan</td>
                                                        <td>{{ $k->diagnosakeperawatan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rencana Keperawatan/Kebidanan</td>
                                                        <td>{{ $k->rencanakeperawatan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tindakan Keperawatan/Kebidanan</td>
                                                        <td>{{ $k->tindakankeperawatan }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Evaluasi Keperawatan/Kebidanan</td>
                                                        <td>{{ $k->evaluasikeperawatan }}</td>
                                                    </tr>
                                                </table>
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <th>Tanggal assesmen</th>
                                                        <th>Nama Pemeriksa</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $k->tanggalassemen }}</td>
                                                            <td>
                                                                <img src="{{ $k->signature_perawat }}"
                                                                    alt=""><br>
                                                                <p class="text-center">{{ $k->namapemeriksa }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                <h5 class="text-danger">Perawat Belum Mengisi ...</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-danger text-bold">Assesmen awal Medis</div>
                                        @if ($k->id_2 != null)
                                            <div class="card-body">
                                                <table class="table table-sm text-sm">
                                                    <tr>
                                                        <td class="text-bold font-italic">Sumber Data</td>
                                                        <td>{{ $k->sumber_data }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Keluhan Pasien</td>
                                                        <td>{{ $k->keluhan_pasien }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Tekanan Darah</td>
                                                        <td>{{ $k->tekanan_darah }} mmHg</td>
                                                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                                                        <td>{{ $k->frekuensi_nafas }} x/menit</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                                                        <td>{{ $k->frekuensi_nadi }} x/menit</td>
                                                        <td class="text-bold font-italic">Suhu Tubuh</td>
                                                        <td>{{ $k->suhu_tubuh }} °C</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-danger">Riwayat Kesehatan
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Riwayat Kehamilan (bagi pasien
                                                            wanita)</td>
                                                        <td>{{ $k->riwayat_kehamilan_pasien_wanita }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Riwayat Kelahiran (bagi pasien
                                                            anak) </td>
                                                        <td>{{ $k->riwyat_kelahiran_pasien_anak }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Riwayat Penyakit Sekarang</td>
                                                        <td>{{ $k->riwyat_penyakit_sekarang }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-danger">Riwayat Penyakit
                                                            Dahulu</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Hipertensi</td>
                                                        <td>{{ $k->hipertensi }}</td>
                                                        <td class="text-bold font-italic">Kencing Manis</td>
                                                        <td>{{ $k->kencingmanis }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Jantung</td>
                                                        <td>{{ $k->jantung }}</td>
                                                        <td class="text-bold font-italic">Stroke</td>
                                                        <td>{{ $k->stroke }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Hepatitis</td>
                                                        <td>{{ $k->hepatitis }}</td>
                                                        <td class="text-bold font-italic">Asthma</td>
                                                        <td>{{ $k->asthma }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Ginjal</td>
                                                        <td>{{ $k->ginjal }}</td>
                                                        <td class="text-bold font-italic">TbParu</td>
                                                        <td>{{ $k->tbparu }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Lainnya</td>
                                                        <td>{{ $k->riwayatlain }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->ket_riwayatlain }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Riwayat Alergi</td>
                                                        <td>{{ $k->riwayat_alergi }}</td>
                                                        <td class="text-bold font-italic">Keterangan</td>
                                                        <td>{{ $k->keterangan_alergi }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Status Generalis</td>
                                                        <td>{{ $k->statusgeneralis }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-danger">Pemeriksaan Fisik
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">{{ $k->pemeriksaan_fisik }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" class="text-bold bg-danger">Pemeriksaan Umum
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Keadaan Umum</td>
                                                        <td>{{ $k->keadaanumum }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Kesadaran</td>
                                                        <td>{{ $k->kesadaran }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Diagnosa Kerja</td>
                                                        <td>{{ $k->diagnosakerja }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Diagnosa Banding</td>
                                                        <td>{{ $k->diagnosabanding }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-bold font-italic">Rencana Kerja</td>
                                                        <td>{{ $k->rencanakerja }}</td>
                                                    </tr>
                                                </table>
                                                <button class="btn btn-info riwayattindakan mt-4"
                                                    kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                                    data-target="#modalriwayattindakan">Riwayat Tindakan</button>
                                                <button class="btn btn-danger hasilpemeriksaankhusus mt-4"
                                                    kodekunjungan="{{ $k->id_kunjungan }}" data-toggle="modal"
                                                    data-target="#modalhasilpemeriksaankhusus">Hasil Pemeriksaan
                                                    Khusus</button>
                                                <table class="table table-sm table-bordered mt-4">
                                                    <thead>
                                                        <th>Tanggal assesmen</th>
                                                        <th>Nama Pemeriksa</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ $k->tgl_pemeriksaan }}</td>
                                                            <td>
                                                                <img src="{{ $k->signature_dokter }}"
                                                                    alt=""><br>
                                                                <p class="text-center">{{ $k->nama_dokter }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <div class="card-body">
                                                <h5 class="text-danger">Dokter Belum Mengisi ...</h5>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayattindakan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="riwayattindakan_m">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalhasilpemeriksaankhusus" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hasil Pemeriksaan Khusus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="hslpmkh">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".riwayattindakan").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayattindakan') ?>',
            success: function(response) {
                $('.riwayattindakan_m').html(response);
            }
        });
    });
    $(".hasilpemeriksaankhusus").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('pemeriksaankhususon') ?>',
            success: function(response) {
                $('.hslpmkh').html(response);
            }
        });
    });
    $(".cetakresume").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('cetakresume/' + kodekunjungan);
    })
</script>
