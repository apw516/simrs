<div class="card">
    <div class="card-header bg-secondary">Order farmasi versi 2</div>
    <div class="card-body">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary riwayatreseppasien" norm="{{ $no_rm }}"
                data-toggle="modal" data-target="#modalriwayatreseppasien"><i class="bi bi-plus"></i> Riwayat
                Resep
                Pasien</button>
            <button type="button" class="btn btn-secondary riwayatresepdokter" data-toggle="modal"
                data-target="#modalriwayatresepdokter"><i class="bi bi-plus"></i>Riwayat Resep Dokter</button>
            <button type="button" class="btn btn-info riwayatorderhariini" data-toggle="modal"
                data-target="#modalriwayatorderhariini"><i class="bi bi-plus"></i>Riwayat Order Resep hari
                ini</button>
            <button type="button" class="btn btn-secondary float-right templateresepdokter" data-toggle="modal"
                data-target="#modaltemplateresepdokter"><i class="bi bi-plus"></i>Template Resep
                Dokter</button>
            <button type="button" class="btn btn-secondary float-right templateracikandokter" data-toggle="modal"
                data-target="#modaltemplateracikandokter"><i class="bi bi-plus"></i>Template Racikan
                Dokter</button>
        </div><br><br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpencarianobat"><i
                class="bi bi-search mr-1 ml-1"></i> Pencarian Obat</button>
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalbuatobatracikan"><i
                class="bi bi-file-earmark-plus mr-1 ml-1"></i>Buat Obat
            Racikan </button>
        <div class="card mt-3">
            <div class="card-header bg-light">List Obat yang dipilih ....</div>
            <div class="card-body">
                <form action="" method="post" class="draft_obat_yang_diorder2">
                    <div class="draft_obat2">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="simpantemplateobat2" name="simpantemplateobat2"
                        value="1">
                    <label class="form-check-label" for="exampleCheck1">Ceklis, untuk simpan resep sebagai
                        template</label>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nama Template</label>
                    <input type="text" class="form-control" name="namatemplate2" id="namatemplate2">
                </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_resep">

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
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Resep Pasien</h5>
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
<div class="modal fade" id="modaltemplateresepdokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Resep Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_template_resep_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaltemplateracikandokter" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Template Racikan Obat Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_riwayat_racikan_obat_dokter">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalriwayatorderhariini" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Order Hari ini ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r_order_tdy">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalpencarianobat" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pencarian Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cari Nama Obat</label>
                            <input type="text" class="form-control" aria-describedby="emailHelp"
                                placeholder="Masukan nama obat ...." name="namaobatcari" id="namaobatcari">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success" style="margin-top:32px"
                            onclick="cariobat()"><i class="bi bi-search"></i> Cari obat</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="v_tabel_obat_pencarian">

                        </div>
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
<div class="modal fade" id="modalbuatobatracikan" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Form Obat Racik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-heaader">Header Racikan</div>
                    <div class="card-body">
                        <form class="headerracikan">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Racikan</label>
                                <input type="email" class="form-control" id="exampleInputEmail1"
                                    name="namaracikan" aria-describedby="emailHelp">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tipe Racikan</label>
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            name="tiperacikan">
                                            <option value="0">Silahkan Pilih</option>
                                            <option value="1">Powder</option>
                                            <option value="2">Non - Powder</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Kemasan</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="kemasan">
                                            <option value="0">Silahkan Pilih</option>
                                            <option value="1">Kapsul</option>
                                            <option value="2">Kertas Perkamen</option>
                                            <option value="3">Pot Salep</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Jumlah Racikan</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            name="jumlahracikan" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Aturan Pakai</label>
                                        <textarea type="password" class="form-control" id="exampleInputPassword1" name="aturanpakairacik"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Cari Komponen Racikan</div>
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" id="namaobatcari2"
                                    placeholder="Masukan nama obat ...">
                            </div>
                            <button type="button" class="btn btn-primary mb-2" onclick="cariobat2()"><i
                                    class="bi bi-search mr-1 ml-1"></i>Cari Obat</button>
                        </form>
                        <div class="v_tabel_obat_komponen">

                        </div>
                        <div class="card">
                            <div class="card-header">List obat yang akan diracik</div>
                            <div class="card-body">
                                <form action="" method="post" class="draft_obat_yang_diracik">
                                    <div class="draft_obat_racik">
                                        <div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="simpansebagaitemplateracik">
                                    <label class="form-check-label" for="exampleCheck1">Ceklis untuk Simpan sebagai
                                        template racikan...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="alertracikan()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" value="{{ $kodekunjungan }}" id="kdkunjunganorder">
<script>
    $(".riwayatreseppasien").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambilriwayatreseppasien') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_resep').html(response);
            }
        });
    })
    $(".riwayatresepdokter").on('click', function(event) {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}"
            },
            url: '<?= route('ambilriwayatresepdokter') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_resep_dokter').html(response);
            }
        });
    })
    $(".templateresepdokter").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambiltemplateresep') ?>',
            error: function(response) {
                spinner.hide();
            },
            success: function(response) {
                spinner.hide();
                $('.v_riwayat_template_resep_dokter').html(response);
            }
        });
    })
    $(".templateracikandokter").on('click', function(event) {
        no_rm = $(this).attr('norm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                no_rm
            },
            url: '<?= route('ambiltemplateracikan') ?>',
            error: function(response) {
                spinner.hide();

            },
            success: function(response) {
                spinner.hide();
                $('.v_riwayat_racikan_obat_dokter').html(response);
            }
        });
    })
    function cariobat() {
        nama = $('#namaobatcari').val()
        kode_kunjungan = $('#kdkunjunganorder').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,kode_kunjungan
            },
            url: '<?= route('caristokobat2') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                spinner.hide()
                $('.v_tabel_obat_pencarian').html(response);
            }
        });
    }
    function cariobat2() {
        nama = $('#namaobatcari2').val()
        kode_kunjungan = $('#kdkunjunganorder').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,kode_kunjungan
            },
            url: '<?= route('caristokobat3') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                spinner.hide()
                $('.v_tabel_obat_komponen').html(response);
            }
        });
    }
    function alertracikan() {
        Swal.fire({
            title: "Data racikan akan disimpan ?",
            text: "Klik OK untuk simpan racikan ...",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanracikan()
            }
        });
    }
    function simpanracikan() {
        no_rm = $('#no_rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader2')
        spinner.show();
        var dataheaderracikan = $('.headerracikan').serializeArray();
        var datadetailracikan = $('.draft_obat_yang_diracik').serializeArray();
        simpantemplate = $('#simpansebagaitemplateracik:checked').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                dataheaderracikan: JSON.stringify(dataheaderracikan),
                datadetailracikan: JSON.stringify(datadetailracikan),
                no_rm,
                kode_kunjungan,
                simpantemplate
            },
            url: '<?= route('simpanracikan') ?>',
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
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    simpanracikan2()
                    spinner.hide();
                }
            }
        });
    }
    function simpanracikan2() {
        spinner = $('#loader2')
        spinner.show();
        $('#modalriwayatresep').modal('hide')
        var max_fields = 10;
        // var wrapper = $(".input_komponen_obat_racik");
        var wrapper = $(".draft_obat_yang_diorder2");
        var x = 1;
        no_rm = $('#no_rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        spinner = $('#loader2')
        spinner.show();
        var dataheaderracikan = $('.headerracikan').serializeArray();
        var datadetailracikan = $('.draft_obat_yang_diracik').serializeArray();
        simpantemplate = $('#simpansebagaitemplateracik:checked').val()
        if (x < max_fields) {
            x++; //text box increment
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    dataheaderracikan: JSON.stringify(dataheaderracikan),
                    datadetailracikan: JSON.stringify(datadetailracikan),
                    no_rm,
                    kode_kunjungan,
                    simpantemplate
                },
                url: '<?= route('simpanracikan2') ?>',
                error: function(response){
                    spinner.hide();
                },
                success: function(response) {
                    // wrapper.after(html);
                    // $('#daftarpxumum').attr('disabled', true);
                    $(wrapper).append(response);
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                    $('#modalbuatobatracikan').modal('toggle');
                    spinner.hide();
                }
            });
        }
    }
</script>
