@extends('ermtemplate.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Cari Pasien</h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomorm" placeholder="Masukan nomor rm ..."
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="caripasien_resume()">Cari Pasien</button>
                        </div>
                    </div>
                </div>
                <div class="vriwayat">

                </div>
            </div>
        </section>
        <script>
             function caripasien_resume()
            {
                nomorm = $('#nomorm').val()
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorm,
                    },
                    url: '<?= route('ambilriwayat_pasien_byrm') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vriwayat').html(response);
                    }
                });
            }
        </script>
        @endsection
