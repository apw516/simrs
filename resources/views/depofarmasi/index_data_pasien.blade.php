@extends('dashboard.layouts.main')
@section('container')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Data Pasien</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v_1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Cari Pasien</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div hidden class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword2" class="sr-only">Nomor RM</label>
                                        <input type="text" class="form-control" id="cari_rm" name="cari_rm"
                                            placeholder="Nomor RM">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="inputPassword2" class="sr-only">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggalcari" name="tanggalcari"
                                            placeholder="Nomor RM" value="{{ $now }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mx-sm-2 mb-2">
                                        <label for="inputPassword2" class="sr-only">Poliklinik </label>
                                        <select class="form-control" id="poliklinik">
                                            <option value="0">- Pilih Poliklinik -</option>
                                            @foreach ($mt_unit as $u)
                                            <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-success mb-2" id="myBtncaripx"
                                        onclick="caripasien_far()"><i class="bi bi-search ml-1 mr-2"></i>Cari
                                        Pasien</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="v_t_pasien_poli">
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div hidden class="v_2">

            </div>
        </div>
    </section>
    <script>
        function caripasien_far() {
                rm = $('#cari_rm').val()
                tanggalcari = $('#tanggalcari').val()
                poliklinik = $('#poliklinik').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        rm,
                        poliklinik,
                        tanggalcari
                    },
                    url: '<?= route('cari_data_pasien') ?>',
                    success: function(response) {
                        $('.v_t_pasien_poli').html(response);
                        spinner.hide()
                    }
                });
            }
    </script>
    @endsection