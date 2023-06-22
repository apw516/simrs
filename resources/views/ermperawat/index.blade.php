@extends('ermtemplate.main')
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
                {{-- @if (auth()->user()->unit == '1002')
                <button class="btn btn-success btnasskep" onclick="ambilform()"><i class="bi bi-file-earmark-ruled mr-2"></i>
                    Form Assesmen Awal</button>
                @endif --}}
                <div class="boxcari mb-3">
                    <form class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only"></label>
                            <input type="date" class="form-control" id="tglawal" placeholder="Password" value="{{ $now }}">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input type="date" class="form-control" id="tglakhir" placeholder="Password"  value="{{ $now }}">
                        </div>
                        <button type="button" class="btn btn-primary mb-2" onclick="caripasien_erm()">Cari Pasien</button>
                    </form>
                </div>
                <div class="vpasien">

                </div>
            </div>
            <div class="container-fluid">
                <div hidden class="formigd">

                </div>
                <div hidden class="formpasien">

                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                ambildatapasien()
            });

            function caripasien_erm() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                $(".btnasskep").removeAttr('hidden', true);
                spinner = $('#loader')
                spinner.show();
                tgl_awal = $('#tglawal').val()
                tgl_akhir = $('#tglakhir').val()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        tgl_awal,
                        tgl_akhir
                    },
                    url: '<?= route('ambildatapasienpoli_cari') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.vpasien').html(response);
                    }
                });
            }

            function batalpilih() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                $(".boxcari").removeAttr('hidden', true);
            }
            function ambildatapasien() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                $(".btnasskep").removeAttr('hidden', true);
                $(".boxcari").removeAttr('hidden', true);
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildatapasienpoli') ?>',
                    success: function(response) {
                        spinner.hide();
                        $('.vpasien').html(response);
                    }
                });
            }

            function bataligd() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                $(".btnasskep").removeAttr('hidden', true);
                $(".formigd").attr('hidden', true);
                ambildatapasien()
            }

            function ambilform() {
                $(".vpasien").attr('hidden', true);
                $(".btnasskep").attr('hidden', true);
                $(".formigd").removeAttr('hidden', true);
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    url: '<?= route('ambilformasskep') ?>',
                    success: function(response) {
                        $('.formigd').html(response);
                        spinner.hide();
                    }
                });
            }
        </script>
    @endsection
