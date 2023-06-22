<div class="card">
    <div class="card-header bg-info">Resume Rehabilitasi Medis</div>
    <div class="card-body">
        @foreach ($resume as $r )
            <div class="card">
                <div class="card-header">{{ $r->keterangan_cppt }}</div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-header text-bold text-lg" style="background-color: rgba(110, 245, 137, 0.745)"><i class="bi bi-plus-lg text-bold mr-3"></i> ( S ) SUBJECTIVE</div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <tr>
                                    <td class="text-bold">Sumber Data</td>
                                    <td class="font-italic">{{ $r->sumberdataperiksa }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Keluhan Utama</td>
                                    <td class="font-italic">{{ $r->keluhanutama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">Umur</td>
                                    <td class="font-italic">{{ $r->usia }} tahun</td>
                                </tr>
                            </table>
                            <table class="table text-sm">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Status Fungsional</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->penggunaanalatbantu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->keterangan_alat_bantu }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Cacat Tubuh</td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->cacattubuh }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->keterangancacattubuh }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table text-sm">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Assesmen Nyeri</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold font-italic">Pasien Mengeluh Nyeri </td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->Keluhannyeri }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3" class="text-bold">
                                            Skala Nyeri Pasien : {{ $r->skalenyeripasien }}

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-bold text-lg" style="background-color: rgba(110, 245, 137, 0.745)"><i class="bi bi-plus-lg text-bold mr-3"></i> ( O ) OBJECTIVE</div>
                        <div class="card-body">

                            <table class="table text-sm">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Tanda - Tanda Vital</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-bold font-italic">Tekanan Darah</td>
                                        <td class="text-bold">
                                            {{ $r->tekanandarah }} mmHg
                                        </td>
                                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                                        <td class="text-bold">
                                            {{ $r->frekuensinadi }} x/menit
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                                        <td class="text-bold">
                                            {{ $r->frekuensinapas }} x/menit
                                        </td>
                                        <td class="text-bold font-italic">Suhu</td>
                                        <td class="text-bold">
                                            {{ $r->suhutubuh }} °C
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic">Riwayat Psikologis</td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->Riwayatpsikologi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold font-italic"></td>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->keterangan_riwayat_psikolog }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Assesmen Resiko Jatuh</th>
                                </thead>
                                <tbody>
                                    <tr class="bg-secondary">
                                        <td colspan="4" class="text-center text-bold font-italic">Metode Up and Go</td>
                                    </tr>
                                    <tr>
                                        <td>Faktor Resiko</td>
                                        <td>Skala</td>
                                    </tr>
                                    <tr>
                                        <td>a</td>
                                        <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak tidak seimbang
                                            (
                                            sempoyongan / limbung ) ?</td>
                                    </tr>
                                    <tr>
                                        <td>b</td>
                                        <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan
                                            duduk ?</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="4" class="text-center text-bold font-italic">Hasil</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-bold">
                                            <div class="form-check form-check-inline">
                                                {{ $r->resikojatuh }}
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <th colspan="4" class="text-center bg-warning">Skrinning Gizi</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-bold font-italic bg-secondary">Metode Malnutrition
                                            Screnning Tools ( Pasien Dewasa )</td>
                                    </tr>
                                    <tr class="bg-light text-bold font-italic">
                                        <td colspan="3">1. Apakah pasien mengalami penurunan berat badan yang tidak diinginkan dalam
                                            6
                                            bulan terakhir ?
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold">{{ $r->Skrininggizi }} <p class="float-right">
                                                {{ $r->beratskrininggizi }}
                                        </td>
                                    </tr>
                                    <tr class="bg-light text-bold font-italic">
                                        <td colspan="4">2. Apakah asupan makanan berkurang karena berkurangnya nafsu makan</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-bold">
                                            {{ $r->status_asupanmkanan }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table">
                                <tr>
                                    <td class="bg-light text-bold font-italic" colspan="4">3. Pasien dengan diagnosa khusus :
                                        Penyakit DM / Ginjal / Hati / Paru / Stroke /
                                        Kanker / Penurunan
                                        imunitas geriatri, lain lain...</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-bold">
                                        {{ $r->diagnosakhusus }} <p class="float-right"> {{ $r->penyakitlainpasien }}
                                    </td>
                                </tr>
                            </table>
                            <table class="table">
                                <tr>
                                    <td class="bg-light text-bold font-italic" colspan="4">4. Bila skor >= 2, pasien beresiko
                                        malnutrisi dilakukan pengkajian lanjut oleh ahli gizi</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ $r->resikomalnutrisi }} <p class="float-right">
                                            {{ $r->tglpengkajianlanjutgizi }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-bold text-lg" style="background-color: rgba(110, 245, 137, 0.745)"><i class="bi bi-plus-lg text-bold mr-3"></i> ( A ) ASSESMENT</div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Diagnosa Keperawatan/Kebidanan</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ $r->diagnosakeperawatan }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-bold text-lg" style="background-color: rgba(110, 245, 137, 0.745)"><i class="bi bi-plus-lg text-bold mr-3"></i> ( P ) PLANNING </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Rencana Keperawatan/Kebidanan</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ $r->rencanakeperawatan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Tindakan Keperawatan/Kebidanan</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ $r->tindakankeperawatan }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-center bg-info">Evaluasi Keperawatan/Kebidanan</td>
                                </tr>
                                <tr>
                                    <td class="text-bold">
                                        {{ $r->evaluasikeperawatan }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if (count($resume) > 0)
            @if ($resume[0]->signature == '')
                <div class="jumbotron">
                    <h1 class="display-4">HALLO, {{ auth()->user()->nama }} !</h1>
                    <p class="lead">Anda telah mengisi form assesmen awal keperawatan rawat jalan ... </p>
                    <hr class="my-4">
                    <p>Pastikan data sudah terisi dengan benar.</p>
                    <a class="btn btn-success btn-lg" href="#" role="button"
                        onclick="simpantandatangan()">Simpan</a>
                </div>
                {{-- <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button> --}}
            @else
                <button class="btn btn-danger float-right" onclick="ambildatapasien()()">Kembali</button>
            @endif
        @else
            <h5>Data tidak ditemukan !</h5>
        @endif
    </div>
</div>
<script type="text/javascript" src="{{ asset('public/signature/js/signature.js') }}"></script>
<script>
    function simpantandatangan() {
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
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan: kodekunjungan,
                        // signature
                    },
                    url: '<?= route('simpanttdperawat') ?>',
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
