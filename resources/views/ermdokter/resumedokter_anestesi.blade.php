<div class="card">
    <div class="card-header bg-info">Resume</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if (count($resume) > 0)
            <table class="table table-sm">
                <tr>
                    <td>Sumber Data</td>
                    <td colspan="3">{{ $resume[0]->sumber_data }}</td>
                </tr>
                <tr>
                    <td>Keluhan Utama</td>
                    <td colspan="3">{{ $resume[0]->keluhan_pasien }}</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td colspan="3">{{ $resume[0]->umur }} tahun</td>
                </tr>
                <tr>
                    <td colspan="4">Tanda - Tanda Vital</td>
                </tr>
                <tr>
                    <td>Tekanan Darah</td>
                    <td>{{ $resume[0]->tekanan_darah }} mmHg</td>
                    <td>Frekuensi Nadi</td>
                    <td>{{ $resume[0]->frekuensi_nadi }} x/menit</td>
                </tr>
                <tr>
                    <td>Frekuensi Nafas</td>
                    <td>{{ $resume[0]->frekuensi_nafas }} x/menit</td>
                    <td>Suhu</td>
                    <td>{{ $resume[0]->suhu_tubuh }} °C</td>
                </tr>
                <tr>
                    <td colspan="4" class="bg-info">Riwayat Kesehatan</td>
                </tr>
                <tr>
                    <td>Riwayat Kehamilan (bagi pasien wanita) </td>
                    <td colspan="3">{{ $resume[0]->riwayat_kehamilan_pasien_wanita }}</td>
                </tr>
                <tr>
                    <td>Riwayat Kelahiran (bagi pasien anak) </td>
                    <td colspan="3">{{ $resume[0]->riwyat_kelahiran_pasien_anak }}</td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Sekarang</td>
                    <td colspan="3">{{ $resume[0]->riwyat_penyakit_sekarang }}</td>
                </tr>
                <tr>
                    <td>Riwayat Penyakit Dahulu</td>
                    <td colspan="3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->hipertensi == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="hipertensi" name="hipertensi" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->kencingmanis == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="kencingmanis" name="kencingmanis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->jantung == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="jantung" name="jantung" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->stroke == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="stroke" name="stroke" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->hepatitis == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="hepatitis" name="hepatitis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->asthma == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="asthma" name="asthma" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->ginjal == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="ginjal" name="ginjal" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->tbparu == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="tb" name="tb" value="1">
                                    <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if ($resume[0]->riwayatlain == 1) checked @endif type="checkbox"
                                        class="form-check-input" id="riwayatlain" name="riwayatlain" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Lain-lain</label>
                                </div>
                            </div>
                        </div>
                        <textarea readonly name="ketriwayatlain" id="ketriwayatlain" class="form-control" placeholder="keterangan lain - lain">{{ $resume[0]->ket_riwayatlain }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Riwayat Alergi</td>
                    <td>{{ $resume[0]->riwayat_alergi }}</td>
                    <td>Keterangan</td>
                    <td>{{ $resume[0]->keterangan_alergi }}</td>
                </tr>
                <tr>
                    <td>Status Generalis</td>
                    <td colspan="3">{{ $resume[0]->statusgeneralis }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Diagnosa (WD & OD)</td>
                    <td colspan="3">{{ $resume[0]->diagnosakerja }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Dasar Diagnosa</td>
                    <td colspan="3">{{ $resume[0]->diagnosabanding }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tindakan Kedokteran</td>
                    <td colspan="3">{{ $resume[0]->tindakanmedis }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Indikasi Tindakan</td>
                    <td colspan="3">{{ $resume[0]->indikasitindakan }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tata Cara</td>
                    <td colspan="3">{{ $resume[0]->tatacara }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Tujuan</td>
                    <td colspan="3">{{ $resume[0]->tujuan }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Resiko</td>
                    <td colspan="3">{{ $resume[0]->resiko }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Komplikasi</td>
                    <td colspan="3">{{ $resume[0]->komplikasi }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Prognosis</td>
                    <td colspan="3">{{ $resume[0]->prognosis }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Alternatif dan Resiko</td>
                    <td colspan="3">{{ $resume[0]->alternatif }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Lain - lain</td>
                    <td colspan="3">{{ $resume[0]->lainlain }}</td>
                </tr>
                <tr>
                    <td class="text-bold">Jawaban Konsul</td>
                    <td colspan="3">{{ $resume[0]->keterangan_tindak_lanjut_2 }}</td>
                </tr>
            </table>
            @if ($resume[0]->signature == '')
                @if ($resume[0]->pic == auth()->user()->id || $resume[0]->pic == '')
                    {{-- <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button> --}}
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
                <button class="btn btn-danger float-right" onclick="ambildatapasien()">Kembali</button>
            @endif
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
                </h3>
                <p>
                    Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                </p>
            </div>
        @endif
    </div>
</div>
<script type="text/javascript" src="{{ asset('public/signature/js/signature.js') }}"></script>
<script>
    // var wrapper = document.getElementById("signature-pad");
    // var clearButton = wrapper.querySelector("[data-action=clear]");
    // var canvas = wrapper.querySelector("canvas");
    // var el_note = document.getElementById("note");
    // var signaturePad;
    // signaturePad = new SignaturePad(canvas);
    // clearButton.addEventListener("click", function(event) {
    //     document.getElementById("note").innerHTML = "The signature should be inside box";
    //     signaturePad.clear();
    // });

    // function my_function() {
    //     document.getElementById("note").innerHTML = "";
    // }

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
