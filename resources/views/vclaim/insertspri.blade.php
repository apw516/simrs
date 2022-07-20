@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert SPRI</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route}}">Dashboard</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Pendaftaran</li> --}}
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container">
            <div class="card">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Jenis Surat</label>
                        <select class="form-control" id="jenissurat2">
                            <option value="1">SPRI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                        <input type="email" class="form-control datepicker" id="tanggalkontrol2"
                            placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nomor Kartu</label>
                        <input type="email" class="form-control" id="nomorkartukontrol2" value=""
                            placeholder="masukan nomor kartu ...">
                        <small id="emailHelp" class="form-text text-danger">masukan nomor kartu untuk pembuatan surat perintah rawat inap</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Poli Kontrol</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="polikontrol2">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                                id="kodepolikontrol2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihpoli" onclick="caripolikontrol2()">Cari Poli</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Dokter</label>
                        <div class="input-group mb-3">
                            <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="dokterkontrol2">
                            <input hidden readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                                id="kodedokterkontrol2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                    data-target="#modalpilihdokter" onclick="caridokterkontrol2()">Cari Dokter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="form-rujukan-khusus">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form_diagnosa">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form_procedure">

                                </div>
                            </div>
                        </div>
                        <button class="btn btn-danger float-right ml-1"><i class="bi bi-x-square"></i>  batal</button>
                        <button class="btn btn-primary float-right" onclick="buatsuratkontrol2()"><i class="bi bi-sd-card"></i> simpan</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>
        function caripolikontrol2() {
          spinner = $('#loader');
          spinner.show();
          jenis = $('#jenissurat2').val()
          nomor = $('#nomorkartukontrol2').val()
          tanggal = $('#tanggalkontrol2').val()
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  jenis,
                  nomor,
                  tanggal
              },
              url: '<?= route('caripolikontrol') ?>',
              error: function(data) {
                  spinner.hide();
                  alert('error!')
              },
              success: function(response) {
                  spinner.hide();
                  $('.vpolikontrol').html(response);
                  // $('#daftarpxumum').attr('disabled', true);
              }
          });
      }

      function caridokterkontrol2() {
          spinner = $('#loader');
          spinner.show();
          jenis = $('#jenissurat2').val()
          kodepoli = $('#kodepolikontrol2').val()
          tanggal = $('#tanggalkontrol2').val()
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  jenis,
                  kodepoli,
                  tanggal
              },
              url: '<?= route('caridokterkontrol') ?>',
              error: function(data) {
                  spinner.hide();
                  alert('error!')
              },
              success: function(response) {
                  spinner.hide();
                  $('.vdokterkontrol').html(response);
                  // $('#daftarpxumum').attr('disabled', true);
              }
          });
      }
      function buatsuratkontrol2() {
            spinner = $('#loader');
            spinner.show();
            nomorkartu = $('#nomorkartukontrol2').val()
            jenissurat = $('#jenissurat2').val()
            tanggalkontrol = $('#tanggalkontrol2').val()
            polikontrol = $('#polikontrol2').val()
            kodepolikontrol = $('#kodepolikontrol2').val()
            dokterkontrol = $('#dokterkontrol2').val()
            kodedokterkontrol = $('#kodedokterkontrol2').val()
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorkartu,
                    jenissurat,
                    tanggalkontrol,
                    kodepolikontrol,
                    kodedokterkontrol
                },
                url: '<?= route('buatsuratkontrol') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(data) {
                    spinner.hide();
                    if (data.metaData.code == 200) {
                        alert(data.metaData.message)
                    } else {
                        alert(data.metaData.message)
                    }
                }
            });
        }
    </script>
@endsection
