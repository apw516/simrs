<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('public/dist/js/jquery-3.js') }}"></script>
    <script src="{{ asset('public/dist/js/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>SIRAMAH</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
        <a class="navbar-brand" href="#"><img src="{{ asset('public/img/LOGO2.png') }}" width="300" height="50"
            class="d-inline-block align-top" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link text-dark" onclick="logout()"><i class="bi bi-door-open"></i> Keluar</a>
            </li>
          </ul>
        </div>
      </nav>
    <div class="container-fluid" style="padding-top: 50px">
        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-light">FORM PASIEN</div>
                    <div class="card-body">
                        <form class="formpasien">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pasien</label>
                                <input type="email" class="form-control" id="namapasien" name="namapasien" value=""
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Alamat</label>
                                <textarea rows="6"type="text" class="form-control" id="alamat" name="alamat"></textarea>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="simpanpasien()">DAFTAR</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card shadow-lg">
                    <div class="card-header bg-success text-light text-bold">DATA PASIEN</div>
                    <div class="card-body">
                        <div class="tabelpasien_igd">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            ambildatapasien()
        });

        function ambildatapasien() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('ambildatapasien_igd') ?>',
                success: function(response) {
                    $('.tabelpasien_igd').html(response);
                }
            });
        }

        function simpanpasien() {
            var data = $('.formpasien').serializeArray();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                },
                url: '<?= route('simpanpemeriksaanperawat_igd') ?>',
                error: function(data) {
                   alert('error')
                },
                success: function(data) {
                    if (data.kode == 500) {
                        alert('error')
                    } else {
                       alert('ok')
                       $('#namapasien').val('')
                       $('#alamat').val('')
                       location.reload()
                    }
                }
            });
        }
        function logout() {
          Swal.fire({
              title: 'Logout',
              text: "Apakah anda ingin logout ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d5',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya',
              cancelButtonText: 'Tidak'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "<?= route('logout') ?>";
              }
          })
      }
    </script>
</body>

</html>
