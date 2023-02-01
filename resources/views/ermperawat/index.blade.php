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
                <div class="vpasien">

                </div>
            </div>
            <div class="container-fluid">
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
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildatapasienpoli') ?>',
                    success: function(response) {
                        $('.vpasien').html(response);
                    }
                });
            }
        </script>
    @endsection
