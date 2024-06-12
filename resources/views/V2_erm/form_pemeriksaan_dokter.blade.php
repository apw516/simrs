<style>
    div.ex3 {
        height: 550px;
        width: 100%;
        overflow-y: auto;
    }

    div.ex1 {
        height: 850px;
        width: 100%;
        overflow-y: auto;
    }
</style>
<input hidden type="text" value="{{ $nomorrm }}" id="nomormform">
<input hidden type="text" value="{{ $kodekunjungan }}" id="kodekunjungan">
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header bg-primary" id="headingOne" onclick="">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-light text-bold" type="button"
                    data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="bi bi-plus"></i> CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
                </button>
            </h2>
        </div>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body ex3">
                <div class="v_riwayat_kujungan">

                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                    data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <i class="bi bi-plus"></i> ASSESMENT RAWAT JALAN
                </button>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                <div class="form_pemeriksaan">

                </div>
                <div class="v_form_order_tindakan">

                </div>
                <div class="v_form_order_farmasi">

                </div>
                <div class="v_form_order_laboratorium">

                </div>
                <div class="v_form_order_radiologi">

                </div>
                <button type="button" class="btn btn-success float-right" onclick="simpanpemeriksaandokter()"><i
                    class="bi bi-save"></i>
                    Simpan</button>
                    <button type="button" class="btn btn-danger float-right ml-1 mr-1" onclick="ambildatapasien()()"><i
                    class="bi bi-backspace mr-1"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalobatreguler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Obat Reguler </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-inline">
                    <div class="form-group mx-sm-5 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="text" class="form-control" id="namaobatreguler"
                            placeholder="Masukan nama obat ...">
                    </div>
                    <button type="button" class="btn btn-primary mb-2" id="cariobatreguler"><i
                            class="bi bi-search"></i> Cari Obat</button>
                </div>
                <div class="v_tabel_obat_reguler mt-3">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalobatracik" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih komponen obat racik </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="card">
                    <div class="card-header font-italic bg-light">Header Racikan</div>
                    <div class="card-body">
                        <form class="formheaderracikan">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Racikan</label>
                                <input type="email" class="form-control" id="namaracikan" name="namaracikan"
                                    placeholder="masukan nama racikan ...">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Jumlah Racikan</label>
                                        <input type="email" class="form-control" id="jumlahracikan"
                                            name="jumlahracikan" placeholder="Masukan jumlah racikan ...">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1">Aturan Pakai</label>
                                        <textarea class="form-control" id="aturanpakairacikan" name="aturanpakairacikan" rows="3"
                                            placeholder="Masukan aturan pakai racikan ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Tipe Racikan</label>
                                        <select class="form-control" id="tiperacikan" name="tiperacikan">
                                            <option value="1">Powder</option>
                                            <option value="2">Non-Powder</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Kemasan</label>
                                        <select class="form-control" id="kemasanracikan" name="kemasanracikan">
                                            <option value="1">Kapsul</option>
                                            <option value="2">Kertas Perkamen</option>
                                            <option value="3">Pot Salep</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-light">Komponen Obat Racik</div>
                    <div class="card-body">
                        <div class="form-inline">
                            <div class="form-group mx-sm-5 mb-2">
                                <label for="inputPassword2" class="sr-only">Password</label>
                                <input type="text" class="form-control" id="namakomponen"
                                    placeholder="Masukan nama obat ...">
                            </div>
                            <button type="button" class="btn btn-primary mb-2" id="carikomponenracik"><i
                                    class="bi bi-search"></i> Cari Obat</button>
                        </div>
                        <div class="v_tabel_obat_komponen mt-3">

                        </div>
                        <label for="" class="mt-2 mb-2">List Komponen Racikan</label>
                        <form action="" method="post" class="formlistkomponenracik">
                            <div class="field_komponen_racik" id="id_field">
                                <div id="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="simpanracikan()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="riwayatpemakaianobatmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Pemakaian Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="v_r_ob">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="riwayatracikan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat racikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ex1">
                <div class="v_r_racikan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var input = document.getElementById("namaobatreguler");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("cariobatreguler").click();
        }
    });
    var input = document.getElementById("namakomponen");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("carikomponenracik").click();
        }
    });
    $("#cariobatreguler").on('click', function(event) {
        nama = $('#namaobatreguler').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_reguler') ?>',
            success: function(response) {
                $('.v_tabel_obat_reguler').html(response);
                spinner.hide()
            }
        });
    })
    $("#carikomponenracik").on('click', function(event) {
        nama = $('#namakomponen').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_komponen') ?>',
            success: function(response) {
                $('.v_tabel_obat_komponen').html(response);
                spinner.hide()
            }
        });
    })
    $(document).ready(function() {
        ambilriwayatkunjungan()
        riwayat_racikan()
        riwayat_pemakaian_obat()
        ambilformpemmeriksaan()
        ambilformtindakan()
        ambilformfarmasi()
        ambilformlaboratorium()
        ambilformradiolgi()
    })
    function formsemua(){
        ambilformpemmeriksaan()
        ambilformtindakan()
        ambilformfarmasi()
        ambilformlaboratorium()
        ambilformradiolgi()
    }
    $(function() {
        $("#tabel_pilih_layanan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(function() {
        $("#tabel_pilih_layanan_lab").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(function() {
        $("#tabel_pilih_layanan_rad").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(".pilihtindakan").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_tindakan"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".pilihlayanan_lab").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_lab"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-6"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    $(".pilihlayanan_rad").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_rad"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-6"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });
    function simpanpemeriksaandokter() {
        var data = $('.formpemeriksaan').serializeArray();
        var data_order_farmasi = $('.formorderfarmasi').serializeArray();
        var data_billing_tindakan = $('.formbillingtindakan').serializeArray();
        var data_order_lab = $('.form_order_lab').serializeArray();
        var data_order_rad = $('.form_order_rad').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                data_order_farmasi: JSON.stringify(data_order_farmasi),
                data_order_lab: JSON.stringify(data_order_lab),
                data_order_rad: JSON.stringify(data_order_rad),
                data_billing_tindakan: JSON.stringify(data_billing_tindakan)
            },
            url: '<?= route('v2_simpanpemeriksaandokter') ?>',
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
                    document.getElementById('field_fix_1').innerHTML = "";
                    document.getElementById('field_fix_tindakan').innerHTML = "";
                    document.getElementById('field_fix_lab').innerHTML = "";
                    document.getElementById('field_fix_rad').innerHTML = "";
                    formsemua()
                }
            }
        });
    }
    function ambilriwayatkunjungan() {
        rm = $('#nomormform').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
            },
            url: '<?= route('v2_riwayatkunjungan') ?>',
            success: function(response) {
                $('.v_riwayat_kujungan').html(response);
            }
        });
    }
    function cariobatreguler() {
        nama = $('#namaobatreguler').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_reguler') ?>',
            success: function(response) {
                $('.v_tabel_obat_reguler').html(response);
                spinner.hide()
            }
        });
    }
    function carikomponenracikan() {
        nama = $('#namakomponen').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nama,
                kodekunjungan
            },
            url: '<?= route('v2_cari_obat_komponen') ?>',
            success: function(response) {
                $('.v_tabel_obat_komponen').html(response);
                spinner.hide()
            }
        });
    }
    function simpanracikan() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "Data racikan akan disimpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                var dataheader = $('.formheaderracikan').serializeArray();
                var datalist = $('.formlistkomponenracik').serializeArray();
                kodekunjungan = $('#kodekunjungan').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        dataheader: JSON.stringify(dataheader),
                        datalist: JSON.stringify(datalist),
                        kodekunjungan
                    },
                    url: '<?= route('v2_add_draft_komponen') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(response, data) {
                        spinner.hide()
                        var wrapper = $(".field_order_farmasi");
                        $('#modalobatracik').modal('hide');
                        document.getElementById('id_field').innerHTML = "";
                        $(wrapper).append(response);
                        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                            e.preventDefault();
                            $(this).parent('div').remove();
                            x--;
                        })
                    }
                });
            }
        });
    }
    function riwayat_order_farmasi() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_farmasi') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_order_farmasi').html(response);
            }
        });
    }
    function riwayat_order_lab() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_lab') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_order_lab').html(response);
            }
        });
    }
    function riwayat_order_rad() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_order_rad') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_order_rad_hari_ini').html(response);
            }
        });
    }
    function riwayat_tindakan() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_tindakan_Tdy') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_tindakan_tdy').html(response);
            }
        });
    }
    function riwayat_pemakaian_obat() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_pemakaian_obat') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_ob').html(response);
            }
        });
    }
    function riwayat_racikan() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_racikan') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_r_racikan').html(response);
            }
        });
    }
    function ambilformpemmeriksaan()
    {
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#nomormform').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,rm
            },
            url: '<?= route('ambil_form_pemeriksaan_dokter_V2') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.form_pemeriksaan').html(response);
            }
        });
    }
    function ambilformtindakan()
    {
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#nomormform').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,rm
            },
            url: '<?= route('ambil_form_order_tindakan_V2') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_form_order_tindakan').html(response);
            }
        });
    }
    function ambilformfarmasi()
    {
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#nomormform').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,rm
            },
            url: '<?= route('ambil_form_order_farmasi_V2') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_form_order_farmasi').html(response);
            }
        });
    }
    function ambilformlaboratorium()
    {
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#nomormform').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,rm
            },
            url: '<?= route('ambil_form_order_laboratorium_V2') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_form_order_laboratorium').html(response);
            }
        });
    }
    function ambilformradiolgi()
    {
        kodekunjungan = $('#kodekunjungan').val()
        rm = $('#nomormform').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,rm
            },
            url: '<?= route('ambil_form_order_radiologi_V2') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_form_order_radiologi').html(response);
            }
        });
    }
</script>
