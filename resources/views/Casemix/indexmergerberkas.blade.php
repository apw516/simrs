@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Merger Berkas Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Merger Berkas Pasien</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">Tentukan data kunjungan</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Awal</label>
                                <input type="date" class="form-control" id="tanggalawal">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="tanggalakhir">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Kunjungan</label>
                                <select class="form-control" id="jeniskunjungan">
                                    <option value="1">Rawat Jalan</option>
                                    <option value="2">Rawat Inap</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Jenis Pasien</label>
                                <select class="form-control" id="jenispasien">
                                    <option value="1">Pasien BPJS</option>
                                    <option value="2">Pasien Umum</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-success" style="margin-top:32px" onclick="caridatakunjungan()"><i
                                    class="bi bi-search mr-1 ml-1"></i> Cari data kunjungan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="v_data">
                    
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    function caridatakunjungan() {
        spinner = $('#loader')
        spinner.show();
        tgl_awal = $('#tanggalawal').val()
        tgl_akhir = $('#tanggalakhir').val()
        jeniskunjungan = $('#jeniskunjungan').val()
        jenispasien = $('#jenispasien').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                tgl_awal,
                tgl_akhir,
                jeniskunjungan,
                jenispasien
            },
            url: '<?= route('caridatakunjungan_casemix') ?>',
            success: function(response) {
                spinner.hide();
                $('.v_data').html(response);
            }
        });
    }
</script>
