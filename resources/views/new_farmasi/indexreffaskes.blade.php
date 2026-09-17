@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Referensi Faskses</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Referensi Faskes</li>
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
            <div class="v_1">
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Data Faskses
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Faskes</label>
                                <select class="form-control" id="jenisfaskes">
                                    <option value="1">Faskes 1</option>
                                    <option value="2">Faskes 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Masukan Nama Faskses</label>
                                <input type="email" class="form-control" id="namafaskes"
                                    placeholder="Ketik nama faskes ....">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button onclick="carifaskes()" style="margin-top:32px" class="btn btn-success">Cari
                                Faskes</button>
                        </div>
                    </div>
                    <div class="card-body v_data_pasien">
                        {{-- <table id="tableDpho" class="table table-sm table-bordered table-striped w-100">
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
                        </table> --}}
                    </div>
                </div>
            </div>
            <!-- Sertakan Script DataTables -->
            <script>
                public
                function carifaskes() {
                    jenisfaskes = $('#jenisfaskes').val()
                    namafaskes = $('#namafaskes').val()
                    spinner = $('#loader')
                    spinner.show();
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            jenisfaskes,
                            namafaskes
                        },
                        url: '<?= route('carifaskes') ?>',
                        error: function(response) {
                            alert('error!')
                            spinner.hide()
                        },
                        success: function(response) {
                            $('.v_data_pasien').html(response);
                            spinner.hide()
                        }
                    });
                }
            </script>
        </div>
    </section>
@endsection
