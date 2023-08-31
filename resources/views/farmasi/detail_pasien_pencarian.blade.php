<div class="card">
    <div class="card-header">Data Pasien</div>
    <input type="text" hidden name="kodekunjungan" id="kodekunjungan" class="form-control" value="{{ $kunjungan[0]->kode_kunjungan }}">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('public/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">{{ $mt_pasien[0]->nama_px }}</h3>
                        <p class="text-muted text-center">{{ $mt_pasien[0]->no_rm }} </p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Tanggal Lahir</b> <a class="float-left text-dark mt-3">
                                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</a>
                            </li>
                            <li class="list-group-item">
                                <b>Alamat</b> <a class="float-right text-dark">{{ $mt_pasien[0]->alamatpasien }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Penjamin</b> <a class="float-right text-dark">{{ $kunjungan[0]->nama_penjamin }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Unit Asal</b> <a class="float-right text-dark">{{ $kunjungan[0]->nama_unit }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-info">Data Order</div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <th>Nama Obat</th>
                                    <th>Qty</th>
                                    <th>Keterangan</th>
                                    <th>Unit Asal</th>
                                    <th>Dokter</th>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-warning">Data Layanan Resep</div>
                            <div class="card-body">
                                <button class="btn btn-success" data-toggle="modal" data-target="#modalcariobat"><i
                                        class="bi bi-search ml-1 mr-2"></i>Cari Obat</button>
                                <div class="row mt-1">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Nama Barang / Layanan</label>
                                            <input readonly type="text" class="form-control text-xs"
                                                id="pre_nama_barang" placeholder="Nama Barang / Layanan">
                                            <input hidden readonly type="text" class="form-control text-xs"
                                                id="pre_kode" placeholder="Nama Barang / Layanan">
                                            <input hidden readonly type="text" class="form-control text-xs"
                                                id="pre_id_ti" placeholder="Nama Barang / Layanan">
                                            <input hidden type="text" class="form-control text-xs" id="harga2"
                                                placeholder="Nama Barang / Layanan">
                                            <input hidden readonly type="text" class="form-control text-xs"
                                                id="pre_satuan" placeholder="Nama Barang / Layanan">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Stok</label>
                                            <input readonly type="text" class="form-control" id="pre_stok"
                                                placeholder="stok">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">QTY</label>
                                            <input type="text" class="form-control" id="pre_qty" placeholder="qty"
                                                value="0" oninput="hitungsubtotal1()">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Harga</label>
                                            <input readonly type="text" class="form-control" id="pre_harga"
                                                placeholder="Harga">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Disc(%)</label>
                                            <input type="text" class="form-control" id="pre_disc"
                                                placeholder="Discount" value="0" oninput="hitungdiskon()">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Dosis Pakai</label>
                                            <textarea type="text" class="form-control" id="pre_dosis" placeholder="Dosis Pakai"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Sub Total</label>
                                            <input readonly type="text" class="form-control" id="pre_sub"
                                                placeholder="Sub total" value="0">
                                            <input hidden readonly type="text" class="form-control" id="pre_sub_2"
                                                placeholder="Sub total" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Action</label><br>
                                            <button class="btn btn-secondary btn-sm" onclick="simpandraft()"><i
                                                    class="bi bi-arrow-down mr-1"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">Draft Layanan Resep</div>
                                    <div class="card-body">
                                        <form action="" method="post" class="form_draf_obat">
                                            <div class="input_obat">
                                                <div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer bg-warning">
                                        <div class="gt">

                                        </div>
                                        <button class="btn btn-success float-right"
                                            onclick="simpanorderan_far()">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalcariobat" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pencarian Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Pencarian Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat_pencarian"
                                name="nama_obat_pencarian" placeholder="Cari Obat ...">
                        </div>
                        <button type="button" class="btn btn-success mb-2" onclick="cariobat()"><i
                                class="bi bi-search ml-1 mr-2"></i>Cari Obat</button>
                    </form>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="v_t_o">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function hitungsubtotal1() {
        diskon = $('#pre_disc').val()
        if (diskon > 0) {
            total = $('#harga2').val() * $('#pre_qty').val()
            diskon = $('#pre_disc').val()
            hitung = diskon / 100 * total
            total2 = total - hitung
            total1 = total2.toLocaleString("IDN", {
                style: "currency",
                currency: "IDR"
            })
            $('#pre_sub').val(total1)
            $('#pre_sub_2').val(total2)
        } else {
            total1 = $('#pre_qty').val() * Math.round($('#harga2').val())
            total = total1.toLocaleString("IDN", {
                style: "currency",
                currency: "IDR"
            })
            total3 = total1
            $('#pre_sub').val(total)
            $('#pre_sub_2').val(total3)
        }
    }

    function hitungdiskon() {
        total = $('#harga2').val() * $('#pre_qty').val()
        diskon = $('#pre_disc').val()
        hitung = diskon / 100 * total
        total2 = total - hitung
        total1 = total2.toLocaleString("IDN", {
            style: "currency",
            currency: "IDR"
        })
        $('#pre_sub').val(total1)
        $('#pre_sub_2').val(total2)
    }

    function simpandraft() {
        var max_fields = 10;
        var wrapper = $(".input_obat");
        var x = 1;
        kode = $('#pre_kode').val()
        namabarang = $('#pre_nama_barang').val()
        harga = $('#pre_harga').val()
        id_stok = $('#pre_id_ti').val()
        harga2 = $('#harga2').val()
        stok_curr = $('#pre_stok').val()
        qty = $('#pre_qty').val()
        disc = $('#pre_disc').val()
        dosis = $('#pre_dosis').val()
        satuan = $('#pre_satuan').val()
        subtot = $('#pre_sub').val()
        subtot2 = $('#pre_sub_2').val()
        if (qty == '0' || kode == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama atau Jumlah obat tidak boleh kosong !',
                footer: '<a href="">Why do I have this issue?</a>'
            })
        } else {
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Barang / Tindakan</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="nama_barang_order" value="' +
                    namabarang +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kode_barang_order" value="' +
                    kode +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="id_stok_order" value="' +
                    id_stok +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="harga2_order" value="' +
                    harga2 +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="sub_total_order_2" value="' +
                    subtot2 +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Stok</label><input readonly type="" class="form-control form-control-sm" id="" name="stok_curr_order" value="' +
                    stok_curr +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Qty</label><input readonly type="" class="form-control form-control-sm" id="" name="qty_order" value="' +
                    qty +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Satuan</label><input readonly type="" class="form-control form-control-sm" id="" name="satuan_order" value="' +
                    satuan +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Harga</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="harga_order" value="' +
                    harga +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Diskon</label><input readonly type="" class="form-control form-control-sm" id="" name="disc_order" value="' +
                    disc +
                    '"></div><div class="form-group col-md-3"><label for="inputPassword4">Aturan Pakai</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="dosis_order" value="' +
                    dosis +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Sub Total</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="sub_total_order" value="' +
                    subtot +
                    '"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2="' +
                    kode + '" subtot="' + subtot2 + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    subtot3 = $(this).attr('subtot')
                    totalitem = $('#totalitem2').val()
                    grandtotal = $('#grandtotal2').val()
                    jumlahitem = $('#jumlahitem').val()
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            subtot3,
                            totalitem,
                            grandtotal,
                            jumlahitem
                        },
                        url: '<?= route('minus_grand_total') ?>',
                        success: function(response) {
                            $('.gt').html(response);
                        }
                    });

                })
            }
            totalitem = $('#totalitem2').val()
            grandtotal = $('#grandtotal2').val()
            jumlahitem = $('#jumlahitem').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    subtot2,
                    totalitem,
                    grandtotal,
                    jumlahitem
                },
                url: '<?= route('jumlah_grand_total') ?>',
                success: function(response) {
                    $('.gt').html(response);
                }
            });

            $('#pre_kode').val('')
            $('#pre_nama_barang').val('')
            $('#pre_harga').val('')
            $('#pre_id_ti').val('')
            $('#harga2').val('')
            $('#pre_stok').val('')
            $('#pre_qty').val(0)
            $('#pre_disc').val(0)
            $('#pre_dosis').val('')
            $('#pre_satuan').val('')
            $('#pre_sub').val(0)
            $('#pre_sub_2').val(0)
        }
    }

    function cariobat() {
        nama = $('#nama_obat_pencarian').val()
        if (nama == ' ') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama obat tidak boleh kosong !',
                footer: '<a href="">Why do I have this issue?</a>'
            })
        } else {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nama
                },
                url: '<?= route('cari_obat_farmasi') ?>',
                success: function(response) {
                    $('.v_t_o').html(response);
                    spinner.hide()
                }
            });
        }
    }

    function simpanorderan_far() {
        var data1 = $('.form_draf_obat').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(data1),
                kodekunjungan
            },
            url: '<?= route('simpanorderan_far') ?>',
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
                }
            }
        });
    }
</script>
