 <table id="tabel_obat_racik" class="table table-sm table-bordered table-hover">
     <thead>
         <th>Nama Barang /Layanan</th>
         <th>Tipe</th>
         <th>Stok Current</th>
         <th>Satuan</th>
         <th>Harga Jual</th>
     </thead>
     <tbody>
         @foreach ($pencarian_obat as $p)
             <tr class="pilihobat" satuan="{{ $p->satuan }}" kode="{{ $p->kode_barang }}"
                 namaobat="{{ $p->nama_barang }}" tarif2="{{ $p->harga_jual }}"
                 tarif="IDR {{ number_format($p->harga_jual, 2) }}" stok_current="{{ $p->stok_current }}"
                 no="{{ $p->NO }}" aturan="{{ $p->aturan_pakai }}">
                 <td>{{ $p->nama_barang }}</td>
                 <td>{{ $p->nama_tipe }}</td>
                 <td>{{ $p->stok_current }}</td>
                 <td>{{ $p->satuan }}</td>
                 <td>IDR {{ number_format($p->harga_jual, 2) }} </td>
             </tr>
         @endforeach
     </tbody>
 </table>
 <script>
     $(function() {
         $("#tabel_obat_racik").DataTable({
             "responsive": false,
             "lengthChange": false,
             "autoWidth": true,
             "pageLength": 3,
             "searching": true
         })
     });
     $('#tabel_obat_racik').on('click', '.pilihobat', function() {
         namaobat = $(this).attr('namaobat')
         tarif = $(this).attr('tarif')
         stok_current = $(this).attr('stok_current')
         aturan = $(this).attr('aturan')
         no = $(this).attr('no')
         tarif2 = $(this).attr('tarif2')
         kode = $(this).attr('kode')
         satuan = $(this).attr('satuan')
         $('#pre_kode_racik').val(kode)
         $('#pre_id_ti_racik').val(no)
         $('#pre_nama_barang_racik').val(namaobat)
         $('#pre_harga_racik').val(tarif)
         $('#harga2_racik').val(tarif2)
         $('#pre_stok_racik').val(stok_current)
         $('#pre_dosis_racik').val(aturan)
         $('#pre_satuan_racik').val(satuan)
         $('#pre_sub_racik').val(0)
         $('#pre_sub_2_racik').val(0)
         $("#pre_qty_racik").val(0);
         $("#pre_qty_racik").focus();
     });
     function simpandraft_racik() {
        var max_fields = 10;
        var wrapper = $(".input_obat_racik");
        var x = 1;
        kode = $('#pre_kode_racik').val()
        namabarang = $('#pre_nama_barang_racik').val()
        harga = $('#pre_harga_racik').val()
        id_stok = $('#pre_id_ti_racik').val()
        harga2 = $('#harga2_racik').val()
        stok_curr = $('#pre_stok_racik').val()
        qty = $('#pre_qty_racik').val()
        disc = $('#pre_disc_racik').val()
        dosis = $('#pre_dosis_racik').val()
        satuan = $('#pre_satuan_racik').val()
        subtot = $('#pre_sub_racik').val()
        subtot2 = $('#pre_sub_2_racik').val()
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
 </script>
