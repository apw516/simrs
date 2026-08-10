@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Log Kartu Stok (Stok Terakhir)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Log Kartu Stok</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- Filter Box -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-filter mr-1"></i> Filter Unit</h3>
                </div>
                <div class="card-body">
                    <form id="filter-form" class="form-inline">
                        <div class="form-group mr-3">
                            <label for="kode_unit" class="mr-2">Kode Unit:</label>
                            <select name="kode_unit" id="kode_unit" class="form-control select2">
                                <option value="">-- Pilih Unit --</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->kode_unit }}" @if(auth()->user()->unit == $unit->kode_unit) selected @endif>{{ $unit->kode_unit }} -
                                        {{ $unit->nama_unit ?? '' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="btn-filter2" class="btn btn-primary goo"><i
                                class="fas fa-search mr-1"></i>
                            Tampilkan</button>
                    </form>
                </div>
            </div>
            <!-- DataTable Box -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Data Stok Terbaru Per Barang</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-kartu-stok" class="table table-bordered table-striped table-hover w-100">
                            <thead>
                                <tr class="bg-light">
                                    <th width="5%">No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Nama Unit</th>
                                    <th>Stok Awal</th>
                                    <th>Masuk</th>
                                    <th>Keluar</th>
                                    <th>Stok Akhir</th>
                                    <th>Keterangan</th>
                                    <th>Tgl Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data dimuat via DataTables Server-side / AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            var table = $('#table-kartu-stok').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('kartu-stok.data') }}",
                    data: function(d) {
                        d.kode_unit = $('#kode_unit').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                    {
                        data: 'kode_barang',
                        name: 'a.kode_barang'
                    },
                    {
                        data: 'nama_barang',
                        name: 'b.nama_barang',
                        defaultContent: '-'
                    },
                    {
                        data: 'nama_unit',
                        name: 'c.nama_unit',
                        className: 'text-center'
                    },
                    {
                        data: 'stok_awal',
                        name: 'a.stok_last',
                        className: 'text-right'
                    },
                    {
                        data: 'stok_masuk',
                        name: 'a.stok_in',
                        className: 'text-right'
                    },
                    {
                        data: 'stok_keluar',
                        name: 'a.stok_out',
                        className: 'text-right'
                    },
                    {
                        data: 'stok_akhir',
                        name: 'a.stok_current',
                        className: 'text-right font-weight-bold'
                    },
                    {
                        data: 'keterangan',
                        name: 'a.keterangan',
                        defaultContent: '-'
                    },
                    {
                        data: 'created_at',
                        name: 'a.tgl_stok',
                        className: 'text-center'
                    }
                ],
                order: false
            });

            $('#btn-filter2').click(function() {
                table.draw();
            });
        });
    </script>
@endsection

<!-- DataTables & Plugins -->
