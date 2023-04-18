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
                {{-- @if(auth()->user()->unit == '1002')
                <button class="btn btn-success btnasskep" onclick="ambilform()"><i class="bi bi-file-earmark-ruled mr-2"></i>
                    Form Assesmen Awal</button>
                @endif --}}
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

            function batalpilih() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
            }

            function ambildatapasien() {
                $(".formpasien").attr('hidden', true);
                $(".vpasien").removeAttr('hidden', true);
                $(".btnasskep").removeAttr('hidden', true);
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

            function bataligd()
            {
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
