<div class="card">
    <div class="card-header">Catatan Hemodialisis</div>
    <div class="card-body">
        <button class="btn btn-success" onclick="buatheader()"><i class="bi bi-file-earmark-plus"></i> Buat
            Catatan Header</button>
        <div hidden class="card mt-4 formheader">
            <div class="card-header bg-success">Form catatan HD <button class="btn btn-danger"
                    onclick="batal()">Batal</button>
            </div>
            <div class="card-body">
                <form action="" class="form_header_pemeriksaan">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Periksa</label>
                        <input type="date" class="form-control" name="tgl_periksa" id="tgl_periksa"
                            aria-describedby="emailHelp">
                    </div>
                    <table class="table table-lg table-bordered">
                        <tr>
                            <td>Preskripsi HD</td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="inisiasi" name="inisiasi">
                                            <label class="form-check-label" for="checkDefault">
                                                Inisiasi
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="akut" name="akut">
                                            <label class="form-check-label" for="checkDefault">
                                                Akut
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="rutin" name="rutin">
                                            <label class="form-check-label" for="checkDefault">
                                                Rutin
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="preop" name="preop">
                                            <label class="form-check-label" for="checkDefault">
                                                Pre-OP
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="sled" name="sled">
                                            <label class="form-check-label" for="checkDefault">
                                                SLED
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">QB</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qb" id="qb">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">QD</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="qd" id="qd">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml/menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="exampleInputEmail1">UF GOAL</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control"
                                                placeholder="Recipient's username" aria-label="Recipient's username"
                                                aria-describedby="basic-addon2" name="ufgoal" name="ufgoal">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ml</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td rowspan="2">
                                Dialist : <br>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="dialist"
                                        name="dialist">
                                    <label class="form-check-label" for="checkDefault">
                                        Bicarbonat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="dialist"
                                        name="dialist">
                                    <label class="form-check-label" for="checkDefault">
                                        Acetat
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="10%">
                                Prog. Profiling
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                id="NA" name="NA">
                                            <label class="form-check-label" for="checkDefault">
                                                Na
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="2"
                                                id="UF" name="UF">
                                            <label class="form-check-label" for="checkDefault">
                                                UF
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="3"
                                                id="bicarbonat" name="bicarbonat">
                                            <label class="form-check-label" for="checkDefault">
                                                Bicarbonat
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-lg table-bordered">
                        <tr>
                            <td>
                                <label for="">Heparinasi</label>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dosis sirkulasi</label>
                                    <input type="password" class="form-control" id="dosissirkulasi"
                                        name="dosissirkulasi">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dosis Awal</label>
                                    <input type="password" class="form-control" id="dosisawal" name="dosisawal">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Dosis maintenance</label><br>
                                    <label for="exampleInputEmail1">Continues</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2"
                                            name="continues" id="continues">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">iu/jam</span>
                                        </div>
                                    </div>
                                    <label for="exampleInputEmail1">Intermitten</label>
                                    <div class="input-group mb-3">
                                        <input name="intermitten" id="intermitten" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">iu/jam</span>
                                        </div>
                                    </div>
                                    <label for="exampleInputEmail1">LWMH</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="LWMH" id="LWMH" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">

                                    </div>
                                    <label for="exampleInputEmail1">Tanpa heparin, penyebab ...</label>
                                    <div class="input-group mb-3">
                                        <input name="tanpaheparin" id="tanpaheparin" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">

                                    </div>
                                    <label for="exampleInputEmail1">Program bilas NaCL 0,9 % 100 cc/jam atau 1/2 jam
                                        ...</label>
                                    <div class="input-group mb-3">
                                        <input name="programbilas" id="programbilas" type="text"
                                            class="form-control" placeholder="Recipient's username"
                                            aria-label="Recipient's username" aria-describedby="basic-addon2">

                                    </div>
                                </div>
                            </td>
                            <td>
                                <label for="exampleInputEmail1">Lama HD</label>
                                <div class="input-group mb-3">
                                    <input name="lamahd" id="lamahd" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">jam</span>
                                    </div>
                                </div>
                                <label for="exampleInputEmail1">Dializer</label>
                                <div class="input-group mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1"
                                            id="dializer" name="dializer">
                                        <label class="form-check-label" for="checkDefault">
                                            Baru
                                        </label>
                                    </div>
                                    <div class="form-check ml-2 mr-2">
                                        <input class="form-check-input" type="checkbox" value="2"
                                            id="dializer" name="dializer">
                                        <label class="form-check-label" for="checkDefault">
                                            Reuse
                                        </label>
                                    </div><br><br>
                                    <div class="input-group mb-3">
                                        <label for="exampleInputEmail1" class="mr-2 ml-2">Ke</label>
                                        <input name="hd_ke" id="hd_ke" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <label for="exampleInputEmail1">BB pre HD</label>
                                    <div class="input-group mb-3">
                                        <input name="bb_pre_hd" id="bb_pre_hd" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <label for="exampleInputEmail1">BB Post HD</label>
                                    <div class="input-group mb-3">
                                        <input name="bb_post_hd" id="bb_post_hd" type="text" class="form-control"
                                            placeholder="Recipient's username" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <label for="exampleInputEmail1">Jam mulai HD</label>
                                <div class="input-group mb-3">
                                    <input name="jam_mulai_hd" id="jam_mulai_hd" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">Jam Selesai HD</label>
                                <div class="input-group mb-3">
                                    <input name="jam_selesai_hd" id="jam_selesai_hd" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">ke ...</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="ke" id="ke" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">HD ke ...</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="hd_ke" id="hd_ke" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">Target BB kering :</label>
                                <div class="input-group mb-3">
                                    <input name="target_bb_kering" id="target_bb_kering" type="text"
                                        class="form-control" placeholder="Recipient's username"
                                        aria-label="Recipient's username" aria-describedby="basic-addon2">
                                </div>
                                <label for="exampleInputEmail1">BB Observasi :</label>
                                <div class="input-group mb-3">
                                    <input name="bb_observasi" id="bb_observasi" type="text" class="form-control"
                                        placeholder="Recipient's username" aria-label="Recipient's username"
                                        aria-describedby="basic-addon2">
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" onclick="simpanheader()">Simpan</button>
                <button class="btn btn-danger" onclick="batal()">Batal</button>
            </div>
        </div>
        <div class="v_riwayat_header">

        </div>
    </div>
</div>
<input hidden id="rm" type="text" value={{ $rm }}>
<input hidden id="kode_kunjungan" type="text" value={{ $kode_kunjungan }}>
<script>
    $(document).ready(function() {
        ambilcatatanhemodialisa()
    })

    function buatheader() {
        $('.formheader').removeAttr('hidden', true)
    }

    function batal() {
        $('.formheader').attr('hidden', true)
    }

    function simpanheader() {
        Swal.fire({
            title: "Anda yakin ?",
            text: "catatan header hd akan disimpan !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ya, simpan"
        }).then((result) => {
            if (result.isConfirmed) {
                simpancatatanheader()
                $('.formheader').attr('hidden', true)
            }
        });
    }

    function simpancatatanheader() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        var data = $('.form_header_pemeriksaan').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                rm,
                kode_kunjungan
            },
            url: '<?= route('simpanheaderpemeriksaanhd') ?>',
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
                    formcatatanhemodialisis()
                }
            }
        });
    }

    function ambilcatatanhemodialisa() {
        spinner = $('#loader')
        spinner.show();
        rm = $('#rm').val()
        kode_kunjungan = $('#kode_kunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode_kunjungan
            },
            url: '<?= route('ambilriwayatcatatanhemodialisa') ?>',
            success: function(response) {
                $('.v_riwayat_header').html(response);
                spinner.hide()
            }
        });
    }
</script>
