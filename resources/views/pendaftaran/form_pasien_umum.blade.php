<div class="container mt-3">
    <div class="card card-outline card-success">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header bg-info">Riwayat Kunjungan</div>
                <div class="card-body">
                    {{-- <button class="btn btn-danger"  data-toggle="modal"
                data-target="#modalriwayatsep"><i class="bi bi-search"></i> Riwayat SEP Terakhir</button> --}}
                    <table id="tabelriwayatkunjungan"
                        class="table table-bordered table-sm text-md table-hover table-striped">
                        <thead>
                            <th>Unit</th>
                            <th>Tgl Masuk</th>
                            <th>Tgl Keluar</th>
                            <th>PENJAMIN</th>
                            <th>Catatan</th>
                            <th>Dokter</th>
                            <th>SEP</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($riwayat_kunjungan as $r)
                                <tr>
                                    <td>{{ $r->nama_unit }}</td>
                                    <td><button class="badge badge-warning">{{ $r->tgl_masuk }}</button></td>
                                    <td>{{ $r->tgl_keluar }}</td>
                                    <td>{{ $r->nama_penjamin }}</td>
                                    <td>{{ $r->CATATAN }}</td>
                                    <td>{{ $r->dokter }}</td>
                                    <td>{{ $r->no_sep }}</td>
                                    <td><button kodekunjungan="{{ $r->kode_kunjungan }}" unit="{{ $r->nama_unit }}" dokter="{{ $r->dokter }}"class="badge badge-info pilihrefranap">Ref Ranap</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-2 justify-content-center">
            <div class="col-md-12">
                <div class="container">
                    <div class="card">
                        <div class="card-header bg-info">Pasien Umum</div>
                        <div class="card-body">
                            <h4 class="text-danger mb-2">*Wajib Diisi</h4>
                            <div class="row">
                                <div class="col-sm-4 text-right text-bold">Jenis Pelayanan</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="jenispelayanan" onchange="gantijenispelayanan()">
                                        <option value="1">Rawat Inap</option>
                                        <option selected value="2">Rawat Jalan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Nama Pasien</div>
                                <div class="col-sm-7">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" readonly class="form-control" id="namapasien"
                                                placeholder="First name" value="{{$mt_pasien[0]->nama_px}}">
                                        </div>
                                        <div class="col">
                                            <input type="text" readonly class="form-control" id="nomorrm"
                                                placeholder="Last name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 pilihpoli">
                                <div class="col-sm-4 text-right text-bold">Tujuan</div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" value=""
                                        placeholder="ketik poli tujuan ..." aria-label="Text input with checkbox"
                                        id="politujuan">
                                    <input hidden type="text" class="form-control" value=""
                                        aria-label="Text input with checkbox" id="kodepolitujuan">
                                </div>
                            </div>
                            <div hidden class="ranap" id="ranap">
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Kelas</div>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="kelasranap">
                                            <option>-- Silahkan Pilih Kelas --</option>
                                            <option value="1">Kelas 1</option>
                                            <option value="2">Kelas 2</option>
                                            <option value="3">Kelas 3</option>
                                            <option value="4">VIP</option>
                                            <option value="5">VVIP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Unit</div>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="unitranap">
                                            <option>-- Silahkan Pilih Unit --</option>
                                            @foreach ($mt_unit as $a)
                                                <option value="{{ $a->kode_unit }}">
                                                    {{ $a->nama_unit }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Kamar / Bed</div>
                                    <div class="col-sm-7">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="namaruanganranap" placeholder="nama ruangan">
                                            </div>
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2" id="kodebedranap"
                                                    placeholder="kode tempat tidur">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2" id="idruangan"
                                                    placeholder="kode tempat tidur">
                                            </div>
                                            <div class="col-auto">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#modalpilihruangan" onclick="cariruangan()"
                                                    class="btn btn-primary mb-2">Pilih ruangan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-4 text-right text-bold">Referensi Kunjungan</div>
                                    <div class="col-sm-7">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2"
                                                    id="unitref" placeholder="Unit">
                                            </div>



                                            <div class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2" id="dokterref"
                                                    placeholder="Dokter">
                                            </div>
                                            <div hidden class="col-auto">
                                                <label class="sr-only" for="inlineFormInput">Name</label>
                                                <input readonly type="text" class="form-control mb-2" id="kodekunjunganref">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mt-2 dokteryangmelayani" id="dokteryangmelayani">
                                <div class="col-sm-4 text-right text-bold">Dokter yang melayani</div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control"
                                        placeholder="ketik dokter yang melayani ..."
                                        aria-label="Text input with checkbox" id="namadokter">
                                    <input hidden type="text" class="form-control" value=""
                                        aria-label="Text input with checkbox" id="kodedokter">
                                </div>
                            </div> --}}
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Tgl masuk</div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                        id="tglmasuk">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Penjamin</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="penjamin">
                                        @foreach ($mt_penjamin as $a)
                                            <option value="{{ $a->kode_penjamin }}"
                                                @if ($a->kode_penjamin == 'P01') selected @endif>
                                                {{ $a->nama_penjamin }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">No SEP</div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="sep"
                                        placeholder="ketik nomor sep jika penjamin bpjs ...">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-4 text-right text-bold">Alasan masuk</div>
                                <div class="col-sm-7">
                                    <select class="form-control" id="alasanmasuk">
                                        @foreach ($alasan_masuk as $a)
                                            <option value="{{ $a->id }}"
                                                @if ($a->id == 1) selected @endif>
                                                {{ $a->alasan_masuk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-7">
                                    <button class="btn btn-danger">Batal</button>
                                    <button class="btn btn-success float-right"
                                        onclick="daftarpasienumum()">Simpan</button>
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
<div class="modal fade" id="modalpilihruangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih ruangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="viewruangan2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabelriwayatkunjungan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "ordering": true,
            "columnDefs": [{
                "targets": 0,
                "type": "date"
            }],
            // "order": [
            //     [1, "desc"]
            // ]
        })
    });
    $('#tabelriwayatkunjungan').on('click', '.pilihrefranap', function() {
        kode = $(this).attr('kodekunjungan')
        dokter = $(this).attr('dokter')
        unit = $(this).attr('unit')
        $('#kodekunjunganref').val(kode)
        $('#dokterref').val(dokter)
        $('#unitref').val(unit)
    });
    $(function() {
        $(".datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
    });

    function gantijenispelayanan() {
        jnsPelayanan = $('#jenispelayanan').val();
        if (jnsPelayanan == 1) {
            $('#ranap').removeAttr('hidden', true)
            $('#dokteryangmelayani').attr('hidden', true)
            $('.pilihpoli').attr('hidden', true)
        } else {
            $('#ranap').attr('hidden', true)
            $('#dokteryangmelayani').removeAttr('hidden', true)
            $('.pilihpoli').removeAttr('hidden', true)
        }
    }
    $(document).ready(function() {
        $('#politujuan').autocomplete({
            source: "<?= route('caripoli_rs') ?>",
            select: function(event, ui) {
                spinner.show();
                $('[id="politujuan"]').val(ui.item.label);
                $('[id="kodepolitujuan"]').val(ui.item.kode);
                spinner.hide();

            }
        });
    });

    function cariruangan() {
        kelas = $('#kelasranap').val()
        unit = $('#unitranap').val()
        spinner = $('#loader');
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kelas,
                unit
            },
            url: '<?= route('cariruangranap2') ?>',
            error: function(data) {
                spinner.hide();
                alert('error!')
            },
            success: function(response) {
                spinner.hide();
                $('#viewruangan2').html(response);
            }
        });
    }

    function daftarpasienumum() {
        jenispelayanan = $('#jenispelayanan').val()
        namapasien = $('#namapasien').val()
        nomorrm = $('#nomorrm').val()
        politujuan = $('#politujuan').val()
        kodepolitujuan = $('#kodepolitujuan').val()
        tglmasuk = $('#tglmasuk').val()
        penjamin = $('#penjamin').val()
        sep = $('#sep').val()
        alasanmasuk = $('#alasanmasuk').val()
        kelasranap = $('#kelasranap').val()
        unitranap = $('#unitranap').val()
        namaruanganranap = $('#namaruanganranap').val()
        kodebedranap = $('#kodebedranap').val()
        idruangan = $('#idruangan').val()
        koderef = $('#kodekunjunganref').val()
        dokterref = $('#dokterref').val()
        if (kodepolitujuan == '') {
            if (jenispelayanan == 1) {
                if(koderef == ''){
                    alert('Pilih referensi kunjungan ditabel riwayat kunjungan ...')
                }else{
                spinner = $('#loader');
                spinner.show();
                $.ajax({
                    async: true,
                    dataType: 'Json',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        jenispelayanan,
                        namapasien,
                        nomorrm,
                        tglmasuk,
                        penjamin,
                        sep,
                        alasanmasuk,
                        kelasranap,
                        unitranap,
                        idruangan,
                        namaruanganranap,
                        kodebedranap,
                        koderef,
                        dokterref                    },
                    url: '<?= route('daftarpasien_umum') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops,silahkan coba lagi',
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == '200') {
                            Swal.fire({
                                title: 'Pendaftaran berhasil !',
                                text: "Cetak nota pembayaran ...",
                                icon: 'success',
                                showCancelButton: true,
                                showDenyButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                denyButtonColor: 'green',
                                denyButtonText: `Cetak Nota dan Label`,
                                confirmButtonText: 'Ya, cetak Nota',
                                cancelButtonText: 'Tidak'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open('cetakstruk/' + data.kode_kunjungan);
                                    location.reload();
                                } else if (result.isDenied) {
                                    // window.open('cetakstruk/' + data.kode_kunjungan);
                                    // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                    var url = 'cetakstruk/' + data.kode_kunjungan
                                    var url2 = `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                        nomorrm + `&nama=` + namapasien;
                                    var locs = [url, url2]
                                    for (let i = 0; i < locs.length; i++) {
                                        window.open(locs[i])
                                    }
                                    location.reload();
                                } else {
                                    location.reload();
                                }
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops, Sorry !',
                                text: data.message,
                            })
                        }
                    }
                });
                //end of pasien ranap
                }
            } else {
                alert('silahkan pilih poli tujuan ...')
            }
        } else {
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jenispelayanan,
                    namapasien,
                    nomorrm,
                    politujuan,
                    kodepolitujuan,
                    tglmasuk,
                    penjamin,
                    sep,
                    alasanmasuk
                },
                url: '<?= route('daftarpasien_umum') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == '200') {
                        Swal.fire({
                            title: 'Pendaftaran berhasil !',
                            text: "Cetak nota pembayaran ...",
                            icon: 'success',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            denyButtonColor: 'green',
                            denyButtonText: `Cetak Nota dan Label`,
                            confirmButtonText: 'Ya, cetak Nota',
                            cancelButtonText: 'Tidak'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.open('cetakstruk/' + data.kode_kunjungan);
                                location.reload();
                            } else if (result.isDenied) {
                                // window.open('cetakstruk/' + data.kode_kunjungan);
                                // window.open('http://localhost/printlabel/cetaklabel.php?rm=19882642&nama=BADRIYAH');
                                var url = 'cetakstruk/' + data.kode_kunjungan
                                var url2 = `http://192.168.2.45/printlabel/cetaklabel.php?rm=` +
                                    nomorrm + `&nama=` + namapasien;
                                var locs = [url, url2]
                                for (let i = 0; i < locs.length; i++) {
                                    window.open(locs[i])
                                }
                                location.reload();
                            } else {
                                location.reload();
                            }
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops, Sorry !',
                            text: data.message,
                        })
                    }
                }
            });
        }
    }
</script>
