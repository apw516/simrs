@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Silahkan Cari Pasien</h1>
                </div>
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
            <table id="tablepasien" class="table table-sm table-hover">
                <thead>
                    <th hidden>kode kunjungan</th>
                    <th></th>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Keluar</th>
                    <th>Alamat</th>
                    <th>Status Pengajuan</th>
                </thead>
                <tbody>
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($kunjungan as $k)
                        @if ($k->status_kunjungan == '2')
                            <tr>
                                <td hidden>{{ $k->ts_kode_kunjungan }}</td>
                                <td>
                                    @if ($k->status_kunjungan == '2')
                                        <button class="badge badge-warning pengajuan" norm="{{ $k->ts_no_rm }}"
                                            kodekunjungan="{{ $k->ts_kode_kunjungan }}" counter="{{ $k->ts_counter }}"
                                            nama="{{ $k->nama }}" tglmasuk="{{ $k->tgl_masuk }}"
                                            tglkeluar="{{ $k->tgl_keluar }}"><i class="bi bi-pencil-square"></i></button>
                                    @endif
                                </td>
                                <td>{{ $k->ts_no_rm }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->tgl_masuk }}</td>
                                <td>{{ $k->tgl_keluar }}</td>
                                <td>{{ $k->alamat }}</td>
                                <td>@if($k->status == '1')Sedang dalam proses approve @elseif ($k->status == '2') Sudah diapprove @endif</td>
                            </tr>
                            @php
                                $n = $n + 1;
                            @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div class="modal fade" id="modalajuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pengajuan Buka Kunjungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="formajuan">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">No RM</div>
                            <div class="col-md-9"><input readonly type="text" class="form-control" name="norm_buka"
                                    id="norm_buka">
                                <input hidden readonly type="text" class="form-control" name="kode_kunjungan"
                                    id="kode_kunjungan">
                                <input hidden readonly type="text" class="form-control" name="counter" id="counter">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">Nama</div>
                            <div class="col-md-9"><input readonly type="text" class="form-control" name="nama_buka"
                                    id="nama_buka"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">Tgl Masuk</div>
                            <div class="col-md-9"><input readonly type="text" class="form-control" name="tgl_masuk_buka"
                                    id="tgl_masuk_buka">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">Tgl Keluar</div>
                            <div class="col-md-9"><input readonly type="text" class="form-control" name="tgl_keluar_buka"
                                    id="tgl_keluar_buka">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-3">Keterangan</div>
                            <div class="col-md-9">
                                <textarea type="text" class="form-control" id="keterangan_buka" name="keterangan_buka"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="simpanajuan()">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#tablepasien").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "searching": true,
                "order": [
                    [0, "desc"]
                ]
            })
        });
        $('#tablepasien').on('click', '.pengajuan', function() {
            spinner = $('#loader')
            spinner.show();
            $("#modalajuan").modal();
            $('#nama_buka').val($(this).attr('nama'))
            $('#tgl_masuk_buka').val($(this).attr('tglmasuk'))
            $('#norm_buka').val($(this).attr('norm'))
            $('#tgl_keluar_buka').val($(this).attr('tglkeluar'))
            $('#kode_kunjungan').val($(this).attr('kodekunjungan'))
            $('#counter').val($(this).attr('counter'))
            spinner.hide()
        })
        function simpanajuan() {
            var data = $('.formajuan').serializeArray();
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanajuan') ?>',
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
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: data.message,
                            footer: ''
                        })
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    }
                }
            });
        }
    </script>
@endsection
