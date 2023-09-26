<div class="card mt-3">
    <div class="card-header">Data Pasien <a class="float-right text-dark text-bold">Tanggal Masuk {{ $kunjungan[0]->tgl_masuk }}</a></div>
    <input type="text" hidden name="kodekunjungan" id="kodekunjungan" class="form-control"
        value="{{ $kunjungan[0]->kode_kunjungan }}">
    <input type="text" hidden name="nomororder" id="nomororder" class="form-control"
        value="@if(count($orderan) > 0 ){{ $orderan[0]->id }} @endif">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">Data Pasien</div>
                            <div class="card-body">
                                <table class="table table-sm text-sm">
                                    <thead>
                                        <th>No RM</th>
                                        <th>Nama</th>
                                        <th>tanggal lahir</th>
                                        <th>Alamat</th>
                                        <th>Penjamin</th>
                                        <th>Unit Asal</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $mt_pasien[0]->no_rm }}</td>
                                            <td>{{ $mt_pasien[0]->nama_px }}</td>
                                            <td>{{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                                                (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</td>
                                            <td>{{ $mt_pasien[0]->alamatpasien }}</td>
                                            <td>{{ $kunjungan[0]->nama_penjamin }}</td>
                                            <td>{{ $kunjungan[0]->nama_unit }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info">Data Order</div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered text-xs">
                                    <thead>
                                        <th>Nama Obat</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                        <th>Unit Asal</th>
                                        <th>Dokter</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderan as $or )
                                            <tr>
                                                <td>{{ $or->kode_barang}}</td>
                                                <td>{{ $or->jumlah_layanan}}</td>
                                                <td>{{ $or->aturan_pakai}}</td>
                                                <td>{{ $or->nama_unit}}</td>
                                                <td>{{ $or->nama_dokter}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
                                    <div class="col-sm-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Stok</label>
                                            <input readonly type="text" class="form-control text-xs" id="pre_stok"
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
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Harga</label>
                                            <input readonly type="text" class="form-control text-xs" id="pre_harga"
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
                                            <textarea type="text" class="form-control text-xs" id="pre_dosis" placeholder="Dosis Pakai"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Sub Total</label>
                                            <input readonly type="text" class="form-control text-xs" id="pre_sub"
                                                placeholder="Sub total" value="0">
                                            <input hidden readonly type="text" class="form-control text-xs"
                                                id="pre_sub_2" placeholder="Sub total" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Status</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="status" value="81">
                                                <label class="form-check-label" for="inlineRadio1">KRONIS</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="status" value="83">
                                                <label class="form-check-label" for="inlineRadio2">HIBAH</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="status" value="80" checked>
                                                <label class="form-check-label" for="inlineRadio3">REGULER</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="inlineRadioOptions" id="status" value="82">
                                                <label class="form-check-label" for="inlineRadio3">KEMOTHERAPI</label>
                                            </div>
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
    aria-labelledby="staticBackdropLabel" aria-="true">
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
                    <div class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Pencarian Nama Obat</label>
                            <input type="text" class="form-control" id="nama_obat_pencarian"
                                name="nama_obat_pencarian" placeholder="Cari Obat ...">
                        </div>
                        <button type="button" class="btn btn-success mb-2" id="myBtncari" onclick="cariobat()"><i
                                class="bi bi-search ml-1 mr-2"></i>Cari Obat</button>
                    </div>
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
        status = $('#status:checked').val()
        if (status == 80) {
            so = 'REGULER'
        } else if (status == 81) {
            so = 'KRONIS'
        } else if (status == 82) {
            so = 'KEMOTHERAPI'
        } else {
            so = 'HIBAH'
        }
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
                    '<div class="form-row text-xs"><div class="form-group col-md-2"><label for="">Nama Barang / Tindakan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="nama_barang_order" value="' +
                    namabarang +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kode_barang_order" value="' +
                    kode +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="id_stok_order" value="' +
                    id_stok +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="harga2_order" value="' +
                    harga2 +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="sub_total_order_2" value="' +
                    subtot2 +
                    '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="status_order_2" value="' +
                    status +
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
                    '"></div><div class="form-group col-md-2"><label for="inputPassword4">Aturan Pakai</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="dosis_order" value="' +
                    dosis +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Staus</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="status_order_1" value="' +
                    so +
                    '"></div><div class="form-group col-md-1"><label for="inputPassword4">Sub Total</label><input readonly type="" class="form-control form-control-sm text-xs" id="" name="sub_total_order" value="' +
                    subtot +
                    '"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2="' +
                    kode + '" subtot="' + subtot2 + '" jenis="' + status + '" nama_barang="' + namabarang +
                    '" kode_barang="' + kode + '" id_stok="' + id_stok + '" harga2="' + harga2 + '" satuan="' +
                    satuan + '" stok="' + stok_curr + '" qty="' + qty + '" harga="' + harga + '" disc="' + disc +
                    '" dosis="' + disc + '" sub="' + subtot + '" sub2="' + subtot2 + '" status="' + status +
                    '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    subtot3 = $(this).attr('subtot')
                    jenis = $(this).attr('jenis')
                    a = $(this).attr('nama_barang')
                    b = $(this).attr('kode_barang')
                    c = $(this).attr('id_stok')
                    d = $(this).attr('harga2')
                    z = $(this).attr('satuan')
                    f = $(this).attr('stok')
                    g = $(this).attr('qty')
                    h = $(this).attr('harga')
                    i = $(this).attr('disc')
                    j = $(this).attr('dosis')
                    k = $(this).attr('sub')
                    l = $(this).attr('sub2')
                    st = $(this).attr('status')
                    $('#pre_nama_barang').val(a)
                    $('#pre_kode').val(b)
                    $('#pre_id_ti').val(c)
                    $('#harga2').val(d)
                    $('#pre_satuan').val(z)
                    $('#pre_stok').val(f)
                    $('#pre_qty').val(g)
                    $('#pre_harga').val(h)
                    $('#pre_disc').val(i)
                    $('#pre_dosis').val(j)
                    $('#pre_sub').val(k)
                    $('#pre_sub_2').val(l)
                    totalitem = $('#totalitem2').val()
                    grandtotal = $('#grandtotal2').val()
                    jumlahitem = $('#jumlahitem').val()
                    resepreguler = $('#resepreguler').val()
                    resepkronis = $('#resepkronis').val()
                    resephibah = $('#resephibah').val()
                    resepkemo = $('#resepkemo').val()
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
                            jumlahitem,
                            jenis,
                            resepreguler,
                            resepkronis,
                            resephibah,
                            resepkemo
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
            resepreguler = $('#resepreguler').val()
            resepkronis = $('#resepkronis').val()
            resephibah = $('#resephibah').val()
            resepkemo = $('#resepkemo').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    subtot2,
                    totalitem,
                    grandtotal,
                    jumlahitem,
                    resepreguler,
                    resepkronis,
                    resephibah,
                    resepkemo,
                    status
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
    var input = document.getElementById("nama_obat_pencarian");
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            document.getElementById("myBtncari").click();
        }
    });

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
        nomororder = $('#nomororder').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data1: JSON.stringify(data1),
                kodekunjungan,
                nomororder
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
                        title: 'Data Berhasil disimpan !',
                        text: "Cetak nota pembayaran . . .",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Cetak',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Berhasil dicetak !',
                                'Nota berhasil dicetak ...',
                                'success'
                            )
                            window.open('cetaketiket/' + data.idheader);
                            window.open('cetaknotafarmasi/' + data.idheader);
                            location.reload()
                        }else{
                            location.reload()
                        }
                    })
                }
            }
        });
    }
</script>
