@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master Barang SIMRS & BPJS</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Master Barang SIMRS & BPJS</li>
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
                <div class="card-header">Data Barang</div>
                <div class="card-body">
                    <table id="tabelbarang" class="table table-sm table-bordered table-hover text-xs">
                        <thead>
                            <th>Kode Barang</th>
                            <th>Kode BPJS</th>
                            <th>Nama Barang</th>
                            <th>Zat Aktif</th>
                            <th>Nama Generik</th>
                            <th>Dosis</th>
                            <th>Sediaan</th>
                            <th>Restriksi</th>
                            <th>Aturan Pakai</th>
                            <th>Entry by</th>
                            <th>Tanggal update</th>
                        </thead>
                        <tbody>
                            @foreach($master_barang as $m)
                                <tr>
                                    <td>{{ $m->kode_barang}}</td>
                                    <td>{{ $m->kode_obat_bpjs}}</td>
                                    <td>{{ $m->nama_barang}}</td>
                                    <td>{{ $m->nama_zat_aktif}}</td>
                                    <td>{{ $m->nama_generik}}</td>
                                    <td>{{ $m->dosis}}</td>
                                    <td>{{ $m->sediaan}}</td>
                                    <td>{{ $m->restriksi}}</td>
                                    <td>{{ $m->aturan_pakai}}</td>
                                    <td>{{ $m->pic}}</td>
                                    <td>{{ $m->tgl_entry}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            $(function() {
                $("#tabelbarang").DataTable({
                    "responsive": false,
                    "lengthChange": false,
                    "pageLength": 10,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                });
            });
        </script>
    @endsection
