<button class="btn btn-danger mb-4" onclick="kembali()"><i class="bi bi-backspace mr-1 ml-1"></i> Kembali</button>
<div class="card">
    <div class="card-header">
        Nomor RM : {{ $header[0]->no_rm }} <br>
        Nama Pasien : {{ $header[0]->nama_pasien }} <br>
        Unit Asal : {{ $header[0]->nama_unit_asal }} <br>
        Tanggal Kirim Order : {{ $header[0]->tanggal_kirim }}
        <input hidden type="text" value="{{ $header[0]->kondekunjungannya }}" id="kodekunjungan">
    </div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0 ">
                        <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            <i class="bi bi-folder-plus mr-2 ml-2"></i> Riwayat resep yang sudah dilayani
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_riwayat_resep">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">Data Obat Yang diorder</div>
            <div class="card-body">
                <div class="card">
                    <div class="card-header">Pencarian Obat</div>
                    <div class="card-body">
                        <div class="input-group mb-3 col-md-4">
                            <input type="text" class="form-control" placeholder="Pencarian obat ..."
                                aria-label="Recipient's username" aria-describedby="button-addon2"
                                id="keypencarianobat">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btncariii"
                                    onclick="cariobat()">Cari Obat</button>
                            </div>
                        </div>
                        <label for="">Tampilkan semua stok ...</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="tampilstok"
                                value="1" checked>
                            <label class="form-check-label" for="inlineRadio1">Tidak</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="tampilstok"
                                value="2">
                            <label class="form-check-label" for="inlineRadio2">Ya</label>
                        </div><br>
                        <div class="btn-group mr-2 mt-3" role="group" aria-label="First group">
                            <button type="button" class="btn btn-secondary"><i class="bi bi-card-text mr-2"></i>
                                Template Resep</button>
                            <button type="button" class="btn btn-secondary showtemplateracikan" data-toggle="modal"
                                data-target="#modaltemplateobatracik"><i class="bi bi-card-text mr-2"></i>
                                Template Obat Racik</button>
                            <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#modalbuatobatracik"><i class="bi bi-file-earmark-plus-fill mr-2"></i> Buat
                                Obat Racik</button>
                        </div>

                        <div class="v_tabel_pencarian_obat mt-3">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" class="formourderobat">
                            @if (count($dataorder2) == 0)
                                <h5 class="text-danger">Tidak ada obat yang dipilih ...</h5>
                            @endif
                            <div class="draft_obat2">
                                <div>
                                    @foreach ($dataorder2 as $d)
                                        <div class="form-row text-md">
                                            <div class="form-group col-md-2 text-md"><label for="">Tipe
                                                    Anestesi</label> <select class="form-control" id="tipeanestesi"
                                                    name="tipeanestesi">
                                                    <option value="REG"
                                                        @if ($d['tipeanestesi'] == 'REG') selected @endif>
                                                        REGULER</option>
                                                    <option value="KRONIS"
                                                        @if ($d['tipeanestesi'] == 'KRONIS') selected @endif>
                                                        KRONIS</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-1"><label for="">Jumlah</label><input
                                                    type="" class="form-control  text-md edit_field"
                                                    id="jumlah" name="jumlah" value="{{ $d['jumlah'] }}">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Nama Barang</label>
                                                <input readonly type=""
                                                    class="form-control  text-md edit_field" id="namabarang"
                                                    name="namabarang" value="{{ $d['namabarang'] }}">
                                                <input hidden readonly type="" class="form-control "
                                                    id="kodebarang" name="kodebarang" value="{{ $d['kodebarang'] }}">
                                                <input readonly type="" class="form-control "
                                                    id="idantrianheader" name="idantrianheader"
                                                    value="{{ $d['id_antrian'] }}">
                                                <input hidden readonly type="" class="form-control "
                                                    id="idheaderorder" name="idheaderorder"
                                                    value="{{ $d['id_header_order'] }}">
                                                <input hidden readonly type="" class="form-control "
                                                    id="iddetailorder" name="iddetailorder"
                                                    value="{{ $d['id_detail_order'] }}">
                                                <input hidden readonly type="" class="form-control "
                                                    id="jenisresep" name="jenisresep"
                                                    value="{{ $d['jenisresep'] }}">
                                            </div>
                                            <div class="form-group col-md-1"><label for="">Dosis</label>
                                                <input readonly type=""
                                                    class="form-control  text-md edit_field" id="dosis"
                                                    name="dosis" value="{{ $d['dosis'] }}">
                                            </div>
                                            <div class="form-group col-md-1"><label for="">Stok</label>
                                                <input readonly type=""
                                                    class="form-control  text-md edit_field" id="stok"
                                                    name="stok" value="{{ $d['stok'] }}">
                                            </div>
                                            <div class="form-group col-md-1">
                                                <label for="">Sediaan</label><input readonly type=""
                                                    class="form-control  text-md edit_field" id="sediaan"
                                                    name="sediaan" value="{{ $d['sediaan'] }}">
                                            </div>
                                            <div class="form-group col-md-3"><label for="">Aturan
                                                    Pakai / Keterangan</label>
                                                <textarea type="" cols="3" rows="3" class="form-control  text-md edit_field" id="aturanpakai"
                                                    name="aturanpakai">{{ $d['aturanpakai'] }}</textarea>
                                            </div>
                                            <i class="bi bi-x-square remove_field form-group col-md-1 text-danger"
                                                kode2=""></i>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ceklis untuk simpan resep sebagai
                                template</label>
                        </div>
                        <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1 ml-1"></i>
                            Kembali</button>
                        <button class="btn btn-success" onclick="simpanpelayanan()"><i
                                class="bi bi-bookmarks-fill mr-1 ml-1"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" value="{{ $idorder }}" id="idorder">
<!-- Modal -->
<div class="modal fade" id="modalbuatobatracik" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Racikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Racikan</label>
                            <input type="email" class="form-control" id="namaracikan" aria-describedby="emailHelp"
                                placeholder="Masukan nama racikan ...">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tipe Racikan</label>
                            <select class="form-control" id="tiperacikan">
                                <option value="powder">Powder</option>
                                <option value="nonpowder">Non Powder</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kemasan Racik</label>
                            <select class="form-control" id="kemasanracikan">
                                <option value="kapsul">Kapsul</option>
                                <option value="kertasperkamen">Kerta Perkamen</option>
                                <option value="potsalep">Pot Salep</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah Racikan</label>
                            <input type="text" class="form-control" id="jumlahracikan"
                                placeholder="Masukan jumlah racikan ...">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Aturan Pakai</label>
                            <textarea rows="5" type="text" class="form-control" id="aturanpakairacik"
                                placeholder="Ketik aturan pakai ..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Komponen Obat Racik</div>
                    <div class="card-body">
                        <div class="input-group mb-3 col-md-4">
                            <input type="text" class="form-control" placeholder="Pencarian obat ..."
                                aria-label="Recipient's username" aria-describedby="button-addon2"
                                id="keypencariankomponenobat">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="btncariii2"
                                    onclick="carikomponenobat()">Cari Obat</button>
                            </div>
                        </div>
                        <div class="v_tb_komponen_obat">

                        </div>
                        <form action="" method="post" class="formkomponenobat" id="F1">
                            <div class="draft_komponen_obat" id="F2">
                                <div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpantemplateracikan()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateobatracik" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Template Racikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_t_R">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpantemplateracikan()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        riwayatresepdilayani()
    });


    function kembali() {
        $('.v_1').removeAttr('hidden', true)
        $('.v_2').attr('hidden', true)
        cariorder()
        cariorder2()

    }
    $('.draft_obat2').on("click", ".remove_field", function(e) { //user click on remove
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    function simpanpelayanan() {
        Swal.fire({
            title: "Anda Yakin ?",
            text: "Pastikan obat yang dipilih sudah benar ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, simpan !"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanpemakaianobat()
            }
        });
    }

    function simpanpemakaianobat() {
        spinneron()
        var data = $('.formourderobat').serializeArray();
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
            url: '<?= route('simpandatapelayanan') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinnerof()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    reload()
                }
            }
        });
    }

    function reload() {
        idorder = $('#idorder').val()
        $('.v_1').attr('hidden', true)
        $(".v_2").removeAttr('hidden', true);
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idorder
            },
            url: '<?= route('detailorderan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_2').html(response);
            }
        });
    }

    function riwayatresepdilayani() {
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatresepdilayani') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_resep').html(response);
            }
        });
    }

    function cariobat() {
        keyword = $('#keypencarianobat').val()
        status = $('#tampilstok:checked').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                keyword,
                kodekunjungan,
                status
            },
            url: '<?= route('ambiltabelhasilcariobat_depo') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tabel_pencarian_obat').html(response);
            }
        });
    }

    function carikomponenobat() {
        keyword = $('#keypencariankomponenobat').val()
        status = $('#tampilstok:checked').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                keyword,
                kodekunjungan,
                status
            },
            url: '<?= route('ambiltabelhasilcarikomponenobat_depo') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_tb_komponen_obat').html(response);
            }
        });
    }
    var input = document.getElementById("keypencarianobat");
    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btncariii").click();
        }
    });
    // Get the input field
    var input2 = document.getElementById("keypencariankomponenobat");
    // Execute a function when the user presses a key on the keyboard
    input2.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btncariii2").click();
        }
    });

    function simpantemplateracikan() {
        Swal.fire({
            title: "Data racikan akan disimpan ?",
            text: "Klik OK untuk simpan",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                SIMPANRACIKAN()
            }
        });
    }

    function SIMPANRACIKAN() {
        namaracikan = $('#namaracikan').val()
        tipperacikan = $('#tiperacikan').val()
        kemasanracikan = $('#kemasanracikan').val()
        jumlahracikan = $('#jumlahracikan').val()
        aturanpakai = $('#aturanpakairacik').val()
        var data = $('.formkomponenobat').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                namaracikan,
                tipperacikan,
                kemasanracikan,
                jumlahracikan,
                aturanpakai,
                kodekunjungan
            },
            url: '<?= route('simpanracikan') ?>',
            error: function(data) {
                spinnerof()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinnerof()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    $("#F2").empty()
                    $('#modalbuatobatracik').modal('hide');
                }
            }
        });
    }
    $(".showtemplateracikan").on('click', function(event) {
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idorder
            },
            url: '<?= route('ambiltemplateracikan') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_t_R').html(response);
            }
        });
    })
</script>
