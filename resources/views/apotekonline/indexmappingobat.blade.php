@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mapping Obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mapping Obat</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Data Apotek</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">Pilih Master Barang SIMRS</div>
                                <div class="card-body">
                                    <table id="tabelmasterbarang" class="table table-hover table-sm table-bordered">
                                        <thead>
                                            {{-- <th>Kode Barang</th> --}}
                                            <th>Nama Barang</th>
                                            <th>Dosis</th>
                                            <th>Sediaan</th>
                                            <th>Aturan Pakai</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($master_barang as $d)
                                                <tr class="pilihbarang" kode_barang="{{ $d->kode_barang }}"
                                                    dosis="{{ $d->dosis }}" sediaan="{{ $d->sediaan }}"
                                                    aturan_pakai = "{{ $d->aturan_pakai }}"
                                                    nama_barang ="{{ $d->nama_barang }}"                                                   
                                                    >
                                                    {{-- <td>{{ $d->kode_barang }}</td> --}}
                                                    <td>{{ $d->nama_barang }} @if($d->id_bpjs != '') 
                                                            <button class="badge badge-success">sudah mapping</button>
                                                        @endif
                                                    </td>
                                                    <td>{{ $d->dosis }}</td>
                                                    <td>{{ $d->sediaan }}</td>
                                                    <td>{{ $d->aturan_pakai }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">Pilih Nama Generik ( BPJS )</div>
                                <div class="card-body">
                                    <table id="tabelmastergenerik" class="table table-hover table-sm table-bordered">
                                        <thead>
                                            {{-- <th>Kode Obat</th> --}}
                                            <th>Nama</th>
                                            <th>Generik</th>
                                            <th>PRB</th>
                                            <th>KRONIS</th>
                                            <th>KEMO</th>
                                            <th>Restriksi</th>
                                            <th>Tgl Update</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($master_generik as $d)
                                                <tr class="pilihgenerik" kodeobatbpjs="{{ $d->kodeobat }}"
                                                    namageneriklengkap="{{ $d->namaobat }}"
                                                    namazataktif="{{ $d->generik }}" prb="{{ $d->prb }}"
                                                    kronis="{{ $d->kronis }}" kemo="{{ $d->kemo }}"
                                                    restriksi="{{ $d->restriksi }}" restriksi="{{ $d->restriksi }}">
                                                    {{-- <td>{{ $d->kodeobat }}</td> --}}
                                                    <td>{{ $d->namaobat }}</td>
                                                    <td>{{ $d->generik }}</td>
                                                    <td>{{ $d->prb }}</td>
                                                    <td>{{ $d->kronis }}</td>
                                                    <td>{{ $d->kemo }}</td>
                                                    <td>{{ $d->restriksi }}</td>
                                                    <td>{{ $d->tgl_download }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">List Barang Yang dimapping ...</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Nama Barang</div>
                                            <div class="card-body">
                                                <form action="" method="post" class="formbarang">
                                                    <div class="draftbarang">

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer">
                                                list barang
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Nama Generik</div>
                                            <div class="card-body">
                                                <form class="datagenerik">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Nama Zat
                                                            Aktif</label>
                                                        <input readonly type="email" class="form-control"
                                                            name="namazataktif" id="namazataktif"
                                                            aria-describedby="emailHelp">
                                                        <input hidden readonly type="email" class="form-control"
                                                            name="kodeobatbpjs"id="kodeobatbpjs"
                                                            aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Nama Generik
                                                            Lengap</label>
                                                        <input readonly type="text" class="form-control"
                                                            name="namageneriklengkap" id="namageneriklengkap">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Restriksi</label>
                                                        <textarea readonly rows="4px" type="text" class="form-control" name="restriksi" id="restriksi"></textarea>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer">
                                                data nama generik
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">Signa Dan Keterangan</div>
                                            <div class="card-body">
                                                <button class="btn btn-success tambahsigna" onclick="addsigna()">+
                                                    Signa</button>
                                                <input hidden type="text" id="selisih" value="">
                                                <input hidden type="text" value="0" id="jumlahsigna2">
                                                <form action="" method="post" class="datasigna">
                                                    <div class="formobatfarmasi2">

                                                    </div>
                                                </form>
                                            </div>
                                            <div class="card-footer">
                                                Data signa & keterangan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-success float-right" onclick="simpandatamapping()">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $("#tabelmasterbarang").DataTable({
                    "responsive": false,
                    "lengthChange": false,
                    "pageLength": 10,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                });
            });
            $(function() {
                $("#tabelmastergenerik").DataTable({
                    "responsive": false,
                    "lengthChange": false,
                    "pageLength": 5,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                });
            });
            $(".pilihbarang").on('click', function(event) {
                kodebarang = $(this).attr('kode_barang')
                dosis = $(this).attr('dosis')
                sediaan = $(this).attr('sediaan')
                nama_barang = $(this).attr('nama_barang')
                aturan_pakai = $(this).attr('aturan_pakai')
                var wrapper = $(".draftbarang");
                $(wrapper).append(
                    '<div class="row text-xs"><div class="form-group col-md-4"><label for="">Nama Barang</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="namabarang" name="namabarang" value="' +
                    nama_barang +
                    '"><input hidden readonly type="" class="form-control form-control-sm text-xs edit_field" id="kodebarang" name="kodebarang" value="' +
                    kodebarang +
                    '"></div><div class="form-group col-md-2"><label for="">Dosis</label><input type="" class="form-control form-control-sm text-xs edit_field" id="dosis" name="dosis" value="' +
                    dosis +
                    '"></div><div class="form-group col-md-2"><label for="">Sediaan</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="sediaan" name="sediaan" value="' +
                    sediaan +
                    '"></div><div class="form-group col-md-3"><label for="">Aturan Pakai</label><textarea type="" class="form-control form-control-sm text-xs edit_field" id="aturanpakai" name="aturanpakai" value="">' +
                    aturan_pakai +
                    '</textarea></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
                );
                Swal.fire({
                    title: "Obat dipilih " + nama_barang,
                    text: "ok!",
                    icon: "success"
                });
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });
            $(".pilihgenerik").on('click', function(event) {
                namazataktif = $(this).attr('namazataktif')
                namageneriklengkap = $(this).attr('namageneriklengkap')
                restriksi = $(this).attr('restriksi')
                kodeobatbpjs = $(this).attr('kodeobatbpjs')
                $('#kodeobatbpjs').val(kodeobatbpjs)
                $('#namazataktif').val(namazataktif)
                $('#namageneriklengkap').val(namageneriklengkap)
                $('#restriksi').val(restriksi)
                Swal.fire({
                    title: "Nama " + namageneriklengkap + " berhasil dipilih ...",
                    text: "ok!",
                    icon: "success"
                });
            });

            function addsigna() {
                var max_fields = 10;
                var wrapper = $(".formobatfarmasi2"); //Fields wrapper
                var x = 1
                jlh = $('#jumlahsigna2').val()
                jumlah_signa = parseInt(jlh)
                if (jumlah_signa == 0) {
                    jumlah_signa++
                } else {
                    jumlah_signa = jumlah_signa + 1
                }
                $('#jumlahsigna2').val(jumlah_signa)
                nomor = parseInt(document.getElementById('jumlahsigna2').value)
                if (x < max_fields) { //max input box allowed
                    // nama = 'namaobat' + nomor
                    // aturan = 'aturanpakai' + nomor
                    $(wrapper).append(
                        '<div class="form-row text-xs"><div class="form-group col-md-5"><label for=""> Signa ' +
                        jumlah_signa +
                        '</label><input type="" class="form-control form-control-sm text-xs" id="signa" name="signa" value="" placeholder="contoh : 3 x 1 "></div><div class="form-group col-md-6"><label for="inputPassword4">Keterangan</label><textarea type="" rows="4" class="form-control form-control-sm text-xs" id="keterangansigna" name="keterangansigna" placeholder="contoh : Sesudah makan, selama 7 hari ..."></textarea></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger"></i></div>'
                    );
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        kode = $(this).attr('kode2')
                        e.preventDefault();
                        $(this).parent('div').remove();
                        jlh = $('#jumlahsigna2').val()
                        jumlah_signa = parseInt(jlh)
                        if (jumlah_signa == 0) {

                        } else {
                            jumlah_signa = jumlah_signa - 1
                        }
                        $('#jumlahsigna2').val(jumlah_signa)
                        x--;
                    })
                    // $('#'+nama).autocomplete({
                    //     source: "<?= route('cariobat') ?>",
                    //     select: function(event, ui) {
                    //         $('[id="namaobat"]').val(ui.item.label);
                    //         $('[id="'+aturan+'"]').val(ui.item.aturan);
                    //     }
                    // });
                }
            }

            function simpandatamapping() {
                Swal.fire({
                    title: "Mapping data obat akan disimpan ?",
                    text: "Pastikan data obat sudah dipilih dengan benar !",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, simpan !"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var data1 = $('.formbarang').serializeArray();
                        var data2 = $('.datagenerik').serializeArray();
                        var data3 = $('.datasigna').serializeArray();
                        spinner = $('#loader')
                        spinner.show();
                        $.ajax({
                            async: true,
                            type: 'post',
                            dataType: 'json',
                            data: {
                                _token: "{{ csrf_token() }}",
                                data1: JSON.stringify(data1),
                                data2: JSON.stringify(data2),
                                data3: JSON.stringify(data3),
                            },
                            url: '<?= route('simpandatamappingobat') ?>',
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
                                    $('#kodeobatbpjs').val('')
                                    $('#namazataktif').val('')
                                    $('#namageneriklengkap').val('')
                                    $('#restriksi').val('')
                                    location.reload()
                                }
                            }
                        });
                    }
                });

            }
        </script>
    @endsection
