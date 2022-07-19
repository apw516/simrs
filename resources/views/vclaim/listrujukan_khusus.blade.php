@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Rujukan Khusus</h1>
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
            <div class="row mt-3">
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Bulan</label>
                    <select id="bulan" class="form-control">
                        <option value="1"> Januari</option>
                        <option value="2"> Februari</option>
                        <option value="3"> Maret</option>
                        <option value="4"> April</option>
                        <option value="5"> Mei</option>
                        <option value="6"> Juni</option>
                        <option value="7"> Juli</option>
                        <option value="8"> Agustus</option>
                        <option value="9"> September</option>
                        <option value="10"> Oktober</option>
                        <option value="11"> November</option>
                        <option value="12"> Desember</option>
                      </select>
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Tahun</label>
                    <input type="text" class="form-control" id="tahunpencarian"
                        placeholder="Masukan tahun pencarian ...">
                </div>
                <div class="col-sm-2 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_carirujukan_khusus()"> <i
                                class="bi bi-search-heart"></i> Tampilkan List </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_hasilpencarian_rujukankhusus">

            </div>
        </div>
    </section>
    <script>
        function vclaim_carirujukan_khusus() {
            bulan = $('#bulan').val()
            tahun = $('#tahunpencarian').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan,
                    tahun
                },
                url: '<?= route('vclaimcarirujukankhusus') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_hasilpencarian_rujukankhusus').html(response);
                }
            });
        }
    </script>
@endsection
