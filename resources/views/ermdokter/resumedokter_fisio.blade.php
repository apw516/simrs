<div class="card">
    <div class="card-header bg-info">Resume</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if (count($resume) > 0)
            <table class="table table-striped">
                <tr>
                    <td colspan="2" class="text-center bg-dark">Layanann Fisik dan Rehabilitasi</td>
                </tr>
                <tr>
                    <td>Anamnesa</td>
                    <td>: {{ $resume['0']->anamnesa}}</td>
                </tr>
                <tr>
                    <td>Pemeriksaan Fisik dan Uji Fungsi</td>
                    <td>: {{ $resume['0']->pemeriksaan_fisik}}</td>
                </tr>
                <tr>
                    <td>Diagnosa Medis ( ICD 10 )</td>
                    <td>: {{ $resume['0']->diagnosakerja}}</td>
                </tr>
                <tr>
                    <td>Diagnosa Fungsi ( ICD 10 )</td>
                    <td>: {{ $resume['0']->diagnosabanding}}</td>
                </tr>
                <tr>
                    <td>Pemeriksaan Penunjang</td>
                    <td>: {{ $resume['0']->rencanakerja}}</td>
                </tr>
                <tr>
                    <td>Tata Laksana KFR ( ICD 9CM )</td>
                    <td>: {{ $resume['0']->tatalaksana_kfr}}</td>
                </tr>
                <tr>
                    <td>Anjuran</td>
                    <td>: {{ $resume['0']->anjuran}}</td>
                </tr>
                <tr>
                    <td>Evaluasi</td>
                    <td>: {{ $resume['0']->evaluasi}}</td>
                </tr>
                <tr>
                    <td>Suspek Penyakit Akibat Kerja</td>
                    <td>: {{ $resume['0']->riwayatlain}} | {{ $resume['0']->ket_riwayatlain}}</td>
                </tr>
            </table>
            <div class="card">
                <div class="card-header bg-dark">Order Farmasi</div>
                <div class="card-body">
                    @if(count($riwayat_order_f) > 0)
                    <table id="tabelorder_farmasi" class="table table-sm table-hover">
                        <thead>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_order_f as $r)
                                @if ($r->status_layanan_header != '3')
                                    <tr>
                                        <td>{{ $r->kode_barang }}</td>
                                        <td>{{ $r->kategori_resep }}</td>
                                        <td>{{ $r->satuan_barang }}</td>
                                        <td>{{ $r->jumlah_layanan }}</td>
                                        <td>{{ $r->aturan_pakai }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            @if ($resume[0]->signature == '')
            @if ($resume[0]->pic == auth()->user()->id || $resume[0]->pic == '')
                {{-- <button class="btn btn-success float-right" onclick="simpantandatangan()">Simpan</button> --}}
                <div class="jumbotron">
                    <h1 class="display-2 mb-3">Terima Kasih !</h1>
                    <p class="lead">Anda telah mengisi form assesmen medis rawat jalan ... </p>
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
