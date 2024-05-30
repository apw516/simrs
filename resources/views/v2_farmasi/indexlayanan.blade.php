@extends('ermtemplate.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Data Antrian Resep</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                {{-- <div class="boxcari mb-3">
                    <form class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only"></label>
                            <input type="date" class="form-control" id="tglawal" placeholder="Password"  value="">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input type="date" class="form-control" id="tglakhir" placeholder="Password"  value="">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" onclick="caripasien_erm()">Cari Pasien</button>
                    </form>
                </div> --}}
                <div class="vpasien">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-bold text-lg">Antrian Reguler / Non Racikan</div>
                                <div class="card-body">
                                    <div class="v_non_racikan">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-bold text-lg">Antrian Racikan</div>
                                <div class="card-body">
                                    <div class="v_racikan">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="container-fluid">
                <div hidden class="formpasien">
                </div>
            </div> --}}
        </section>
        <script>
            $(document).ready(function() {
                ambilantrianreguler()
                ambilantrianracikan()
            });
            function ambilantrianreguler(){
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambilantrianreguler') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.v_non_racikan').html(response);
                    }
                });
            }
            function ambilantrianracikan(){
                alert('ok')
            }
        </script>
    @endsection
