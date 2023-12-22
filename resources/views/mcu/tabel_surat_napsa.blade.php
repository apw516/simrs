@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Cetak Surat Napza</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="vpasien">

                </div>
        </section>
        <script>
              $(document).ready(function() {
                ambildatasurat()
            });
            function ambildatasurat() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambildatasuratnapsa') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vpasien').html(response);
                    }
                });
            }
        </script>
    @endsection
