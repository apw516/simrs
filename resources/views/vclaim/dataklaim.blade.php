@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Klaim</h1>
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
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Pilih Bulan</label>
                    <select class="form-control" id="bulan">
                        <option value="01">JANUARI</option>
                        <option value="02">FEBRUARI</option>
                        <option value="03">MARET</option>
                        <option value="04">APRIL</option>
                        <option value="05">MEI</option>
                        <option value="06">JUNI</option>
                        <option value="07">JULI</option>
                        <option value="08">AGUSTUS</option>
                        <option value="09">SEPTEMBER</option>
                        <option value="10">OKTOBER</option>
                        <option value="11">NOVEMBER</option>
                        <option value="12">DESEMBER</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Tahun</label>
                        <select class="form-control" id="tahun">
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <label for="exampleInputEmail1">Jenis Pelayanan</label>
                    <select class="form-control" id="jenislayan">
                        <option value="1">Rawat Inap</option>
                        <option value="2">Rawat Jalan</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="exampleInputEmail1">Status Klaim</label>
                    <select class="form-control" id="status">
                        <option value="1">Proses Verifikasi</option>
                        <option value="2">Pending Verifikasi</option>
                        <option value="3">Klaim</option>
                    </select>
                </div>
                <div class="col-sm-3 form-inline">
                    <div class="form-group mt-4">
                        <label for="exampleInputEmail1"></label>
                        <button type="submit" class="btn btn-primary" onclick="vclaim_dataklaim()"> <i
                                class="bi bi-search-heart"></i> Cari</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="view_dataklaim">

            </div>
        </div>
    </section>
    <script>
       function vclaim_dataklaim() {
            bulan = $('#bulan').val()
            tahun = $('#tahun').val()
            jenislayan = $('#jenislayan').val()
            status = $('#status').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    bulan,
                    tahun,
                    jenislayan,
                    status
                },
                url: '<?= route('vclaimcaridataklaim') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.view_dataklaim').html(response);
                }
            });
        }
    </script>
@endsection
