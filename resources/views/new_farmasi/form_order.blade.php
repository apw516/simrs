<div class="card">
    <div class="card-header">Form Order Farmasi</div>
    <div class="card-body">
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <button hidden type="button" class="btn btn-secondary"><i class="bi bi-journal-bookmark mr-1"></i> Riwayat
                Resep Hari
                Ini</button>
            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalpencarianobat"><i
                    class="bi bi-search mr-1"></i> Pencarian Obat</button>
            <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#modalbuatobatracik"><i
                    class="bi bi-file-earmark-plus mr-1"></i> Buat Obat
                Racikan</button>
            <button type="button" class="btn btn-secondary templateracikan" data-toggle="modal" data-target="#modaltemplateracikan"><i
                    class="bi bi-file-earmark-plus mr-1"></i> Template Obat
                Racikan</button>
            <button type="button" class="btn btn-secondary templateresep" data-toggle="modal"
                data-target="#modaltemplateresep"><i class="bi bi-book mr-1"></i> Template Resep</button>
            <button type="button" class="btn btn-secondary riwayatreseppasien" data-toggle="modal"
                data-target="#modalriwayatreseppasien"><i class="bi bi-journal-bookmark mr-1"></i> Riwayat Resep
                Pasien</button>
            <button type="button" class="btn btn-secondary riwayatresepdokter" data-toggle="modal"
                data-target="#modalriwayatresepdokter"><i class="bi bi-journal-bookmark mr-1"></i> Riwayat Resep
                Dokter</button>
        </div>
        <div class="card mt-4">
            <div class="card-header bg-light text-bold font-lg">List obat yang akan diorder </div>
            <div class="card-body">
                <form action="" method="post" class="formourderobat">
                    <div class="draft_obat2">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <label for="exampleInputPassword1">Masukan nama template</label>
                    <input type="text" class="form-control" id="namatemplate" name="namatemplate"
                        placeholder="masukan nama template ...">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="simpansebagaitemplateresep"
                        name="simpansebagaitemplate">
                    <label class="form-check-label" for="exampleCheck1">Simpan sebagai template</label>
                </div>

                <button class="btn btn-success" onclick="simpanorderobat()">Simpan</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-light text-bold font-lg">
                Riwayat Resep Yang sudah diorder ...
            </div>
            <div class="card-body">
                <div class="v_r_resep"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalpencarianobat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cari Obat ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari Obat ..."
                        aria-label="Recipient's username" aria-describedby="basic-addon2" id="keywordobat">
                    <div class="input-group-append">
                        <span class="btn btn-primary" id="cariobattombol" onclick="cariobat()"><i
                                class="bi bi-search mr-1 ml-1"></i> Cari Obat</span>
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
                </div>
            </div>
            <div class="card">
                <div class="card-header">Hasil Pencarian</div>
                <div class="card-body">
                    <div class="v_hasil_cari_obat">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatreseppasien" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Pasien ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_resep_pasien">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalriwayatresepdokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Dokter ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_resep_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateresep" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep Dokter ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_template_resep">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateracikan" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Racikan ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_template_racikan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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

</div>
<input hidden type="text" name="rm" id="rm" value="{{ $rm }}">
<input hidden type="text" name="kodekunjungan" id="kodekunjungan" value="{{ $kodekunjungan }}">
<script>
    function spinneron() {
        spinner = $('#loader')
        spinner.show();
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
    function spinnerof() {
        spinner = $('#loader')
        spinner.hide();
    }
    var input = document.getElementById("keywordobat");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("cariobattombol").click();
        }
    });
    $(document).ready(function() {
        ambilriwayatresep()
    });

    function ambilriwayatresep() {
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayatresepdibuat') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_resep').html(response);
            }
        });
    }

    function cariobat() {
        keyword = $('#keywordobat').val()
        kodekunjungan = $('#kodekunjungan').val()
        status = $('#tampilstok:checked').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                keyword,
                kodekunjungan,
                status
            },
            url: '<?= route('ambiltabelhasilcariobat') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_hasil_cari_obat').html(response);
            }
        });
    }
    $(".templateresep").on('click', function(event) {
        rm = $('#rm').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('riwayattemplateresep') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_template_resep').html(response);
            }
        });
    })
    $(".templateracikan").on('click', function(event) {
        rm = $('#rm').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('riwayatracikandokter') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_template_racikan').html(response);
            }
        });
    })
    $(".riwayatreseppasien").on('click', function(event) {
        rm = $('#rm').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('riwayatreseppasien') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_resep_pasien').html(response);
            }
        });
    })
    $(".riwayatresepdokter").on('click', function(event) {
        rm = $('#rm').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('riwayatresepdokter') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_riwayat_resep_dokter').html(response);
            }
        });
    })

    function simpanorderobat() {
        spinneron()
        var data = $('.formourderobat').serializeArray();
        var template = $('#simpansebagaitemplateresep:checked').val()
        namatemplate = $('#namatemplate').val()
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#rm').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                template,
                namatemplate,
                kodekunjungan,
                rm
            },
            url: '<?= route('simpanorderobat') ?>',
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
                    ambilformfarmasi2()
                    ambilriwayatresep()
                }
            }
        });
    }
</script>
