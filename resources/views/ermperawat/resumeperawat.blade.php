<div class="card">
    <div class="card-header bg-info">Resume</div>
    <div class="card-body">
        @if (count($resume) > 0)
            <table class="table table-sm table-bordered">
                <tr>
                    <td class="text-bold">Sumber Data</td>
                    <td class="font-italic">{{ $resume[0]->sumberdataperiksa }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Keluhan Utama</td>
                    <td class="font-italic">{{ $resume[0]->keluhanutama }}</td>
                </tr>
            </table>
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Tanda - Tanda Vital</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Tekanan Darah</td>
                        <td class="text-bold">
                            {{ $resume[0]->tekanandarah }} mmHg
                        </td>
                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                        <td class="text-bold">
                            {{ $resume[0]->frekuensinadi }} x/menit
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                        <td class="text-bold">
                            {{ $resume[0]->frekuensinapas }} x/menit
                        </td>
                        <td class="text-bold font-italic">Suhu</td>
                        <td class="text-bold">
                            {{ $resume[0]->suhutubuh }} °C
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Psikologis</td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->Riwayatpsikologi }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->keterangan_riwayat_psikolog }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Status Fungsional</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->penggunaanalatbantu }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->keterangan_alat_bantu }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Cacat Tubuh</td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->cacattubuh }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->keterangancacattubuh }}
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
                            {{ $resume[0]->Keluhannyeri }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3" class="text-bold">
                            Skala Nyeri Pasien : {{ $resume[0]->skalenyeripasien }}

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
                                {{ $resume[0]->resikojatuh }}
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
                        <td class="text-bold">{{ $resume[0]->Skrininggizi }} <p class="float-right">
                                {{ $resume[0]->beratskrininggizi }}
                        </td>
                    </tr>
                    <tr class="bg-light text-bold font-italic">
                        <td colspan="4">2. Apakah asupan makanan berkurang karena berkurangnya nafsu makan</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-bold">
                            {{ $resume[0]->status_asupanmkanan }}
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
                        {{ $resume[0]->diagnosakhusus }} <p class="float-right"> {{ $resume[0]->penyakitlainpasien }}
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
                        {{ $resume[0]->resikomalnutrisi }} <p class="float-right">
                            {{ $resume[0]->tglpengkajianlanjutgizi }}
                        </p>
                    </td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <td colspan="4" class="text-center bg-info">Diagnosa Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td class="text-bold">
                        {{ $resume[0]->diagnosakeperawatan }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Rencana Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td class="text-bold">
                        {{ $resume[0]->rencanakeperawatan }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Tindakan Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td class="text-bold">
                        {{ $resume[0]->tindakankeperawatan }}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Evaluasi Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td class="text-bold">
                        {{ $resume[0]->evaluasikeperawatan }}
                    </td>
                </tr>
            </table>
            <table class="table mt-4">
                <thead>
                    <th>Nama Perawat</th>
                    <th>Tanda Tangan</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold text-md">{{ auth()->user()->nama }}</td>
                        <td>
                            @if ($resume[0]->signature == '')
                                <div id="signature-pad">
                                    <div
                                        style="border:solid 1px teal; width:360px;height:110px;padding:3px;position:relative;">
                                        <div id="note" onmouseover="my_function();">tulis tanda tangan didalam
                                            box ...
                                        </div>
                                        <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                    </div>
                                    <div style="margin:10px;">
                                        <input hidden type="" id="signature" name="signature">
                                        <button type="button" id="clear_btn" class="btn btn-danger"
                                            data-action="clear"><span class="glyphicon glyphicon-remove"></span>
                                            Clear</button>
                                    </div>
                                </div>
                            @else
                                <img src="{{ $resume[0]->signature }}" alt="">
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($resume[0]->signature == '')
                <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button>
            @endif
        @else
            <h5>Data tidak ditemukan !</h5>
        @endif
    </div>
</div>
<script type="text/javascript" src="{{ asset('public/signature/js/signature.js') }}"></script>
<script>
    var wrapper = document.getElementById("signature-pad");
    var clearButton = wrapper.querySelector("[data-action=clear]");
    var canvas = wrapper.querySelector("canvas");
    var el_note = document.getElementById("note");
    var signaturePad;
    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function(event) {
        document.getElementById("note").innerHTML = "The signature should be inside box";
        signaturePad.clear();
    });

    function my_function() {
        document.getElementById("note").innerHTML = "";
    }

    function simpantandatangan() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        var canvas = document.getElementById("the_canvas");
        var dataUrl = canvas.toDataURL();
        if (dataUrl ==
            'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAABkCAYAAADOvVhlAAADOklEQVR4Xu3UwQkAAAgDMbv/0m5xr7hAIcjtHAECBAikAkvXjBEgQIDACa8nIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECDweoABlt2MJjgAAAABJRU5ErkJggg=='
        ) {
            dataUrl = ''
        }
        document.getElementById("signature").value = dataUrl;
        signature = $('#signature').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: kodekunjungan,
                signature
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
                }
            }
        });
    }
</script>
