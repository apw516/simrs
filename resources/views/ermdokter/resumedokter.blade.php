<div class="card">
    <div class="card-header bg-info">Resume</div>
    <div class="card-body">
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
                                    <input @if($resume[0]->hipertensi == 1) checked @endif type="checkbox" class="form-check-input" id="hipertensi" name="hipertensi"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hipertensi</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->kencingmanis == 1) checked @endif type="checkbox" class="form-check-input" id="kencingmanis"
                                        name="kencingmanis" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Kencing Manis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->jantung == 1) checked @endif type="checkbox" class="form-check-input" id="jantung" name="jantung"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Jantung</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->stroke == 1) checked @endif type="checkbox" class="form-check-input" id="stroke" name="stroke"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Stroke</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->hepatitis == 1) checked @endif type="checkbox" class="form-check-input" id="hepatitis" name="hepatitis"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Hepatitis</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->asthma == 1) checked @endif type="checkbox" class="form-check-input" id="asthma" name="asthma"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Asthma</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->ginjal == 1) checked @endif type="checkbox" class="form-check-input" id="ginjal" name="ginjal"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">Ginjal</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->tbparu == 1) checked @endif type="checkbox" class="form-check-input" id="tb" name="tb"
                                        value="1">
                                    <label class="form-check-label" for="exampleCheck1">TB Paru</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input @if($resume[0]->riwayatlain == 1) checked @endif type="checkbox" class="form-check-input" id="riwayatlain" name="riwayatlain"
                                        value="1">
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
                    <td colspan="4" class="bg-info">Pemeriksaan Umum</td>
                </tr>
                <tr>
                    <td>Keadaan Umum</td>
                    <td colspan="3">{{ $resume[0]->keadaanumum }}</td>
                </tr>
                <tr>
                    <td>Kesadaran</td>
                    <td colspan="3">{{ $resume[0]->kesadaran }}</td>
                </tr>
                <tr>
                    <td>Diagnosa Kerja</td>
                    <td colspan="3">{{ $resume[0]->diagnosakerja }}</td>
                </tr>
                <tr>
                    <td>Diagnosa Banding</td>
                    <td colspan="3">{{ $resume[0]->diagnosabanding }}</td>
                </tr>
                <tr>
                    <td>Rencana Kerja</td>
                    <td colspan="3">{{ $resume[0]->rencanakerja }}</td>
                </tr>
            </table>
            <table class="table mt-4">
                <thead>
                    <th>Nama Dokter</th>
                    <th>Tanda Tangan</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold text-md">{{ $resume[0]->nama_dokter }}</td>
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
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...</h3>
            <p>
              Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
            </p>
          </div>
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
            url: '<?= route('simpanttddokter') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'ermwaled2023'
                })
            },
            success: function(data) {
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
