<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-outline card-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                Nomor RM
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['nomorm'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Nama
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['nama'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Jenis Kelamin
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['jk'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Alamat
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['alamat'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Unit
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['unit'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Kelas Unit
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['kelas'] }}
                                <input hidden type="text" id="kelas_unit_pasien" value="{{ $pasien['kelas'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Penjamin
                            </div>
                            <div class="col-md-9">
                                : {{ $pasien['penjamin'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success">Input Layanan</div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control col-md-5" placeholder="Total jenis layanan ..."
                            aria-label="Recipient's username" id="jlhjnslayanan" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="button" onclick="add_layanan_penunjang()"><i
                                    class="bi bi-plus text-md"></i></button>
                        </div>
                    </div>
                    <div class="formlayanan2">

                    </div>
                </div>
                <div class="card-footer">
                    <div class="adatombol" hidden>
                        <button class="btn btn-danger" onclick="location.reload()">Reset</button>
                        <button class="btn btn-success" onclick="simpanbilling()">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function add_layanan_penunjang() {
        jnslayanan = $('#jlhjnslayanan').val()
        if (jnslayanan != '') {
            $('.adatombol').removeAttr('Hidden', true)
        } else {
            $('.adatombol').attr('Hidden', true)
        }
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jnslayanan
            },
            url: '<?= route('billingformlayanan') ?>',
            error: function(data) {
                alert('error!')
            },
            success: function(response) {
                $('.formlayanan2').html(response);
            }
        });
    }

    function simpanbilling() {
        jlhjnslayanan = $('#jlhjnslayanan').val()
        nl1 = $('#nl1').val()
        kodenl1 = $('#kodenl1').val()
        tl1 = $('#tl1').val()
        jlh1 = $('#jlh1').val()
        disc1 = $('#disc1').val()
        cyto1 = $('#cyto1').val()

        nl2 = $('#nl2').val()
        kodenl2 = $('#kodenl2').val()
        tl2 = $('#tl2').val()
        jlh2 = $('#jlh2').val()
        disc2 = $('#disc2').val()
        cyto2 = $('#cyto2').val()

        nl3 = $('#nl3').val()
        kodenl3 = $('#kodenl3').val()
        tl3 = $('#tl3').val()
        jlh3 = $('#jlh3').val()
        disc3 = $('#disc3').val()
        cyto3 = $('#cyto3').val()

        nl4 = $('#nl4').val()
        kodenl4 = $('#kodenl4').val()
        tl4 = $('#tl4').val()
        jlh4 = $('#jlh4').val()
        disc4 = $('#disc4').val()
        cyto4 = $('#cyto4').val()

        nl5 = $('#nl5').val()
        kodenl5 = $('#kodenl5').val()
        tl5 = $('#tl5').val()
        jlh5 = $('#jlh5').val()
        disc5 = $('#disc5').val()
        cyto5 = $('#cyto5').val()

        spinner = $('#loader');
        spinner.show();
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                jlhjnslayanan,
                nl1,
                kodenl1,
                tl1,
                jlh1,
                disc1,
                cyto1,
                nl2,
                kodenl2,
                tl2,
                jlh2,
                disc2,
                cyto2,
                nl3,
                kodenl3,
                tl3,
                jlh3,
                disc3,
                cyto3,
                nl4,
                kodenl4,
                tl4,
                jlh4,
                disc4,
                cyto4,
                nl5,
                kodenl5,
                tl5,
                jlh5,
                disc5,
                cyto5
            },
            url: '<?= route('simpanlayanan') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Rujukan khusus Berhasil dibuat !',
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                    })
                }
            }
        });
    }
</script>
