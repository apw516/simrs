<div class="card">
    <div class="card-header bg-info">Laporan Operasi</div>
    <div class="card-body">
        <input hidden type="text" id="rm" value="{{ $rm }}">
        <input hidden type="text" id="kode_kunjungan" value="{{ $kode_kunjungan }}">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header bg-danger" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left text-light text-bold collapsed" type="button"
                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                            aria-controls="collapseOne" onclick="ambil_form_laporan_1()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Operasi
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body bg-light">
                        <div class="v_Laporan_1">

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan1()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Operasi </i> </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo" onclick="ambil_form_laporan_2()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Injeksi Intra Vitreal
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_2">

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan2()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Injeksi Intra Vitreal </i> </button>
                    </div>
                </div>
            </div>
            <div  hidden class="card">
                <div class="card-header bg-danger" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree" onclick="ambil_form_laporan_3()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Operasi Pterygium
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_3">

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan3()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Operasi Pterygium </i> </button>
                    </div>
                </div>
            </div>
            <div  hidden class="card">
                <div class="card-header bg-danger" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour" onclick="ambil_form_laporan_4()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Operasi Trabeculektomi
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_4">

                        </div>
                    </div>
                     <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan4()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Operasi Trabeculektomi </i> </button>
                    </div>
                </div>
            </div>
            <div  hidden class="card">
                <div class="card-header bg-danger" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                            aria-controls="collapseFive" onclick="ambil_form_laporan_5()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Operasi Katarak dan Glaukoma
                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_5">

                        </div>
                    </div>
                      <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan5()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Operasi Katarak dan Glaukoma </i> </button>
                    </div>
                </div>
            </div>
            <div hidden  class="card">
                <div class="card-header bg-danger" id="headingSix">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                            aria-controls="collapseSix"  onclick="ambil_form_laporan_6()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Laporan Operasi Katarak
                        </button>
                    </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_6">

                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" onclick="simpanlaporan6()"><i class="bi bi-download mr-1 ml-1">
                                Simpan Laporan Operasi Katarak</i> </button>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-danger" id="headingSeven">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed text-light text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                            aria-controls="collapseSeven" onclick="ambil_form_laporan_7()">
                            <i class="bi bi-menu-button mr-1 ml-1"></i> Pemantauan Anestesi Lokal
                        </button>
                    </h2>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="v_Laporan_7">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function ambil_form_laporan_1() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_1') ?>',
            success: function(response) {
                $('.v_Laporan_1').html(response);
                spinner.hide()
            }
        });
    }

    function ambil_form_laporan_2() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_2') ?>',
            success: function(response) {
                $('.v_Laporan_2').html(response);
                spinner.hide()
            }
        });
    }

    function ambil_form_laporan_3() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_3') ?>',
            success: function(response) {
                $('.v_Laporan_3').html(response);
                spinner.hide()
            }
        });
    }
    function ambil_form_laporan_4() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_4') ?>',
            success: function(response) {
                $('.v_Laporan_4').html(response);
                spinner.hide()
            }
        });
    }
    function ambil_form_laporan_5() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_5') ?>',
            success: function(response) {
                $('.v_Laporan_5').html(response);
                spinner.hide()
            }
        });
    }
    function ambil_form_laporan_6() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_6') ?>',
            success: function(response) {
                $('.v_Laporan_6').html(response);
                spinner.hide()
            }
        });
    }
    function ambil_form_laporan_7() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('form_laporan_operasi_7') ?>',
            success: function(response) {
                $('.v_Laporan_7').html(response);
                spinner.hide()
            }
        });
    }

    function simpanlaporan1() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formlaporanoperasi1').serializeArray();
        kodekunjungan = $('#kode_kunjungan').val()
        rm = $('#rm').val()
        politujuan = $('#politujuan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                rm,
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanlaporanoperasi1') ?>',
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
                    ambil_form_laporan_1()
                }
            }
        });
    }

    function simpanlaporan2() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formlaporanoperasi2').serializeArray();
        kodekunjungan = $('#kode_kunjungan').val()
        injeksiantibiotik = $('#injeksiantibiotik:checked').val()
        injeksiantivegp = $('#injeksiantivegp:checked').val()
        avastine = $('#avastine:checked').val()
        patizra = $('#patizra:checked').val()
        eylea = $('#eylea:checked').val()
        tindakanaseptikdanantiseptik = $('#tindakanaseptikdanantiseptik:checked').val()
        lokasiinjek4mm = $('#lokasiinjek4mm:checked').val()
        lokasiinjek3mm = $('#lokasiinjek3mm:checked').val()
        injeksivegf = $('#injeksivegf:checked').val()
        injeksiantibiotik2 = $('#injeksiantibiotik2:checked').val()
        tetesmataantibiotik = $('#tetesmataantibiotik:checked').val()
        balut = $('#balut:checked').val()
        rm = $('#rm').val()
        politujuan = $('#politujuan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                rm,
                data: JSON.stringify(data),
                injeksiantibiotik,
                injeksiantivegp,
                avastine,
                patizra,
                eylea,
                tindakanaseptikdanantiseptik,
                lokasiinjek4mm,
                lokasiinjek3mm,
                injeksivegf,
                injeksiantibiotik2,
                tetesmataantibiotik,
                balut
            },
            url: '<?= route('simpanlaporanoperasi2') ?>',
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
                    ambil_form_laporan_1()
                }
            }
        });
    }

    function simpanlaporan3() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formlaporanoperasi3').serializeArray();
        kodekunjungan = $('#kode_kunjungan').val()
        nu = $('#nu:checked').val()
        Retrobular = $('#Retrobular:checked').val()
        Peribular = $('#Peribular:checked').val()
        Topikal = $('#Topikal:checked').val()
        Subtenon = $('#Subtenon:checked').val()
        Subkonjungtiva = $('#Subkonjungtiva:checked').val()
        tindakanaseptik = $('#tindakanaseptik:checked').val()
        injeksilidocain = $('#injeksilidocain:checked').val()
        guntingjaringanpterygium = $('#guntingjaringanpterygium:checked').val()
        perdarahan = $('#perdarahan:checked').val()
        injeksilidocaine = $('#injeksilidocaine:checked').val()
        pengambilangraft = $('#pengambilangraft:checked').val()
        pemberiansalep = $('#pemberiansalep:checked').val()
        operasiselesai = $('#operasiselesai:checked').val()
        rm = $('#rm').val()
        politujuan = $('#politujuan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                rm,
                data: JSON.stringify(data),
                nu,
                Retrobular,
                Peribular,
                Topikal,
                Subtenon,
                Subkonjungtiva,
                tindakanaseptik,
                injeksilidocain,
                guntingjaringanpterygium,
                perdarahan,
                injeksilidocaine,
                pengambilangraft,
                pemberiansalep,
                operasiselesai,
                rm,
                politujuan

            },
            url: '<?= route('simpanlaporanoperasi3') ?>',
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
                    ambil_form_laporan_1()
                }
            }
        });
    }
</script>
