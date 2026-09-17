@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Referensi DPHO Apotek Online</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Referensi DPHO Apotek online</li>
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
            {{-- <div class="v_1">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Data DPHO
                        </h3>
                    </div>

                    <div class="v_data_pasien mt-2">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Obat</th>
                                <th>Generik</th>
                                <th>PRB</th>
                                <th>Kronis</th>
                                <th>Kemo</th>
                                <th>Harga</th>
                                <th>restriksi</th>
                            </thead>
                            <tbody>
                                @foreach ($list_obat->response->list as $list)
                                    <tr>
                                        <td></td>
                                        <td>{{ $list->kodeobat}}</td>
                                        <td>{{ $list->namaobat}}</td>
                                        <td>{{ $list->generik}}</td>
                                        <td>{{ $list->prb}}</td>
                                        <td>{{ $list->kronis}}</td>
                                        <td>{{ $list->kemo}}</td>
                                        <td>{{ $list->harga}}</td>
                                        <td>{{ $list->restriksi}}</td>
                                   
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            <div class="v_1">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Data DPHO
                        </h3>
                    </div>

                    <div class="card-body v_data_pasien">
                        <table id="tableDpho" class="table table-sm table-bordered table-striped w-100">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kode</th>
                                    <th>Nama Obat</th>
                                    <th>Generik</th>
                                    <th>PRB</th>
                                    <th>Kronis</th>
                                    <th>Kemo</th>
                                    <th>Harga</th>
                                    <th>Restriksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_obat->response->list as $list)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $list->kodeobat }}</td>
                                        <td>{{ $list->namaobat }}</td>
                                        <td>{{ $list->generik }}</td>
                                        <td>{{ $list->prb }}</td>
                                        <td>{{ $list->kronis }}</td>
                                        <td>{{ $list->kemo }}</td>
                                        <td>{{ number_format($list->harga, 0, ',', '.') }}</td>
                                        <td>{{ $list->restriksi }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Sertakan Script DataTables -->
            <script>
                $(document).ready(function() {
                    $('#tableDpho').DataTable({
                        "responsive": true,
                        "lengthChange": true,
                        "autoWidth": false,
                        "pageLength": 10,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                        }
                    });
                });
            </script>
        </div>
    </section>
@endsection
