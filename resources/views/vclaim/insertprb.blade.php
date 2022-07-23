@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert PRB</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route}}">Dashboard</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Pendaftaran</li> --}}
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Nomor SEP</div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Ketik Nomor sep ..." id="sep_prb">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Nomor Kartu</div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Ketik Nomor kartu ..." id="noka_prb">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Email</div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="email peserta ..." id="email_prb">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Program PRB</div>
                        <div class="col-sm-4">
                            <div class="input-group mb-3">
                                <input readonly type="text" class="form-control" placeholder="Pilih program PRB..."
                                    aria-label="Recipient's username" id="programprb" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" data-toggle="modal"
                                        data-target="#modalprogramprb" type="button"><i
                                            class="bi bi-plus text-md"></i></button>
                                    <input hidden type="text" class="form-control" placeholder="Ketik Nomor kartu ..."
                                        id="kodeprogramprb">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Dokter</div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" placeholder="Pilih dokter  ..." id="dokter_prb">
                            <input hidden type="text" class="form-control" placeholder="Pilih dokter  ..."
                                id="kodedokter_prb">
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Alamat</div>
                        <div class="col-sm-4">
                            <textarea type="text" class="form-control" placeholder="Alamat pasien ..." id="alamatpx_prb"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Keterangan</div>
                        <div class="col-sm-4">
                            <textarea type="text" class="form-control" placeholder="keterangan ..." id="keterangan_prb"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Saran</div>
                        <div class="col-sm-4">
                            <textarea type="text" class="form-control" placeholder="saran ..." id="saran_prb"></textarea>
                        </div>
                    </div>
                    <div class="row mt-2 dokterlayan">
                        <div class="col-sm-4 text-right text-bold">Total Jenis Obat</div>
                        <div class="col-sm-4">
                            {{-- <input type="text" class="form-control"> --}}
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Total jenis obat ..."
                                    aria-label="Recipient's username" id="jlhjns_obat" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="button" onclick="add_jenisobat()"><i
                                            class="bi bi-plus text-md"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-rujukan-khusus">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form_jenis_obat">

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger float-right ml-1" onclick="location.reload()"><i class="bi bi-x-square"></i> batal</button>
                        <button class="btn btn-primary float-right" onclick="simpanrujukan_prb()"><i
                                class="bi bi-sd-card"></i> simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalprogramprb" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pilihan program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="tableprogramprb" class="table table-sm table-bordered text-center">
                            <thead>
                                <th>Kode</th>
                                <th>Nama Diagnosa</th>
                                <th>---</th>
                            </thead>
                            <tbody>
                                @foreach ($program_prb->response->list as $p)
                                    <tr>
                                        <td> {{ $p->kode }} </td>
                                        <td> {{ $p->nama }} </td>
                                        <td> <button class="badge badge-success pilihprogram" nama="{{ $p->nama }}"
                                                kode="{{ $p->kode }}" data-dismiss="modal">+</button> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            $("#tableprogramprb").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tableprogramprb').on('click', '.pilihprogram', function() {
            nama = $(this).attr('nama')
            kode = $(this).attr('kode')
            $('#programprb').val(nama + ' ( ' +kode + ' ) ')
            $('#kodeprogramprb').val(kode)
        });
        $(document).ready(function() {
            $('#dokter_prb').autocomplete({
                source: "<?= route('caridokter') ?>",
                select: function(event, ui) {
                    $('[id="dokter_prb"]').val(ui.item.label);
                    $('[id="kodedokter_prb"]').val(ui.item.kode);
                }
            });
        });

        function add_jenisobat() {
            jlhjns_obat = $('#jlhjns_obat').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jlhjns_obat
                },
                url: '<?= route('vclaimambil_formjenisobat') ?>',
                error: function(data) {
                    alert('error!')
                },
                success: function(response) {
                    $('.form_jenis_obat').html(response);
                }
            });
        }

        function simpanrujukan_prb() {
            sep_prb = $('#sep_prb').val()
            noka_prb = $('#noka_prb').val()
            email_prb = $('#email_prb').val()
            kodeprogramprb = $('#kodeprogramprb').val()
            kodedokter_prb = $('#kodedokter_prb').val()
            alamatpx_prb = $('#alamatpx_prb').val()
            keterangan_prb = $('#keterangan_prb').val()
            saran_prb = $('#saran_prb').val()
            jlhobat = $('#jlhjns_obat').val()
            kodeobat1 = $('#kodeobat1').val()
            signa1_1 = $('#signa1_1').val()
            signa2_1 = $('#signa2_1').val()
            jmlhobt1 = $('#jmlhobt1').val()
            //1
            kodeobat2 = $('#kodeobat2').val()
            signa1_2 = $('#signa1_2').val()
            signa2_2 = $('#signa2_2').val()
            jmlhobt2 = $('#jmlhobt2').val()
            //1
            kodeobat3 = $('#kodeobat3').val()
            signa1_3 = $('#signa1_3').val()
            signa2_3 = $('#signa2_3').val()
            jmlhobt3 = $('#jmlhobt3').val()
            //1
            kodeobat4 = $('#kodeobat4').val()
            signa1_4 = $('#signa1_4').val()
            signa2_4 = $('#signa2_4').val()
            jmlhobt4 = $('#jmlhobt4').val()
            //1
            kodeobat5 = $('#kodeobat5').val()
            signa1_5 = $('#signa1_5').val()
            signa2_5 = $('#signa2_5').val()
            jmlhobt5 = $('#jmlhobt5').val()
            //1
            kodeobat6 = $('#kodeobat6').val()
            signa1_6 = $('#signa1_6').val()
            signa2_6 = $('#signa2_6').val()
            jmlhobt6 = $('#jmlhobt6').val()
            //1
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    sep_prb,
                    noka_prb,
                    email_prb,
                    kodeprogramprb,
                    kodedokter_prb,
                    alamatpx_prb,
                    keterangan_prb,
                    saran_prb,
                    jlhobat,
                    kodeobat1,
                    signa1_1,
                    signa2_1,
                    jmlhobt1,
                    kodeobat2,
                    signa1_2,
                    signa2_2,
                    jmlhobt2,
                    kodeobat3,
                    signa1_3,
                    signa2_3,
                    jmlhobt3,
                    kodeobat4,
                    signa1_4,
                    signa2_4,
                    jmlhobt4,
                    kodeobat5,
                    signa1_5,
                    signa2_5,
                    jmlhobt5,
                    kodeobat6,
                    signa1_6,
                    signa2_6,
                    jmlhobt6
                },
                url: '<?= route('vclaimsimpan_prb') ?>',
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
@endsection
