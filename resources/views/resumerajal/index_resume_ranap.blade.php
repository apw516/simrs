@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Resume medis rawat inap</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Resume medis rawat inap</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <embed src="\\193.193.193.203\erm\resume_medis_rawat_jalan/4337d65780ed47a49688a36aea4d55f6.pdf" type="application/pdf"   height="700px" width="500">
    <section class="content">
        <div class="container-fluid form-awal-cari-resep">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tglawal"
                            placeholder="Example input placeholder" value="{{ $now }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tglakhir" value="{{ $now }}"
                            placeholder="Example input placeholder">
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-success btn-sm" style="margin-top:33px" onclick="cariberkas()"><i class="bi bi-search mr-1 ml-1"></i> Cari Berkas</button>
                </div>
            </div>
            <div class="v_log_data">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            cariberkas()
        });

        function cariberkas() {
            spinner = $('#loader')
            spinner.show();
            awal = $('#tglawal').val()
            akhir = $('#tglakhir').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    awal,akhir
                },
                url: '<?= route('cariresume_bykunjungan_ranap') ?>',
                success: function(response) {
                    $('.v_log_data').html(response);
                    spinner.hide()
                }
            });
        }
    </script>
@endsection
