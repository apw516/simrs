@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Layanan</h1>
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
            <div class="vpasien">
                <table id="tabelpasien_penunjang" class="table table-bordered table-sm text-xs table-striped table-hover">
                    <thead>
                        <th>Unit</th>
                        <th>Nomor RM</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Dokter</th>
                        <th>Penjamin</th>
                        <th>--</th>
                    </thead>
                    <tbody>
                        @foreach ($data_pasien as $p)
                            <tr>
                                <td>{{ $p->nama_unit }}</td>
                                <td>{{ $p->no_rm }}</td>
                                <td>{{ $p->nama_px }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td>{{ $p->nama_paramedis }}</td>
                                <td>{{ $p->nama_penjamin }}</td>
                                <td>
                                    <button class="badge badge-primary pilihpasien" nomorrm="{{ $p->no_rm }}"
                                        nama="{{ $p->nama_px }}" alamat="{{ $p->alamat }}"
                                        jk="{{ $p->jenis_kelamin }}" dokter="{{ $p->nama_paramedis }}"
                                        kode_kunjungan="{{ $p->kode_kunjungan }}" namapenjamin ="{{ $p->nama_penjamin }}" penjamin="{{ $p->kode_penjamin }}"
                                        kelas="{{ $p->KELAS_UNIT }}" kode_unit="{{ $p->kode_unit }}"
                                        unit="{{ $p->nama_unit }}"> <i class="bi bi-pencil-square"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="formlayanan">

            </div>
        </div>
    </section>
    <script>
        $(function() {
            $("#table-tarif").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $(function() {
            $("#tabelpasien_penunjang").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tabelpasien_penunjang').on('click', '.pilihpasien', function() {
            spinner = $('#loader')
            spinner.show();
            spinner.hide();
            nomorrm = $(this).attr('nomorrm')
            nama = $(this).attr('nama')
            alamat = $(this).attr('alamat')
            jk = $(this).attr('jk')
            dokter = $(this).attr('dokter')
            kodekunjungan = $(this).attr('kode_kunjungan')
            penjamin = $(this).attr('penjamin')
            npenjamin = $(this).attr('namapenjamin')
            kelas = $(this).attr('kelas')
            kode_unit = $(this).attr('kode_unit')
            unit = $(this).attr('unit')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm,
                    nama,
                    alamat,
                    jk,
                    dokter,
                    kodekunjungan,
                    penjamin,
                    npenjamin,
                    kelas,
                    kode_unit,
                    unit
                },
                url: '<?= route('formlayanan') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.formlayanan').html(response)
                }
            });
        });
    </script>
@endsection
