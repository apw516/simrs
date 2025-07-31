<button class="btn btn-danger" onclick="ambildatapasien()"><i class="bi bi-backspace mr-1"></i>Kembali</button>
<div class="row mt-3">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/img/user.jpg') }}"
                        alt="User profile picture">
                </div>

                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} | {{  $mt_pasien[0]->no_rm }}</h3>

                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-md">Diagnosa :
                    @if(count($last_assdok) > 0)
                    <br>{{ $last_assdok[0]->diagnosakerja }}</p>
                    @else
                    <br>{{ $kunjungan[0]->diagx }}</p>
                    @endif
                <a href="#" onclick="formcatatanmedis3({{ $kunjungan[0]->no_rm }})" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalcatatanmedis"><b>Catatan
                        Medis</b></a>
                {{-- <a href="#" onclick="formcatatanmedis({{ $kunjungan[0]->no_rm }})" class="btn btn-primary btn-block"><b>Catatan
                        Medis</b></a> --}}
                <input hidden type="text" id="kodekunjungan" value="{{ $kunjungan[0]->kode_kunjungan }}">
                <input hidden type="text" id="nomorrm" value="{{ $kunjungan[0]->no_rm }}">
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pemeriksaan</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formbillingtindakan()">
                            <i class="fas fa-inbox mr-2"></i>Billing Tindakan PoliKlinik
                        </a>
                    </li>
                     <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formupload()">
                            <i class="fas fa-inbox mr-2"></i>Upload Berkas
                        </a>
                    </li>
                    @if(auth()->user()->unit != '1028')
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan()">
                            <i class="fas fa-inbox mr-2"></i>Catatan Perkembangan Pasien Terintegrasi ( CPPT )
                        </a>
                    </li>
                    @if(auth()->user()->unit == '1029' || auth()->user()->unit == '1045')
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formsumarilis()">
                            <i class="fas fa-inbox mr-2"></i>SUMARILIS
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formmonitoringdarah()">
                            <i class="fas fa-inbox mr-2"></i>MONITORING TRANSFUSI DARAH
                        </a>
                    </li>
                    @endif
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="hasilpemeriksaanmedis()">
                            <i class="fas fa-inbox mr-2"></i>Hasil Pemeriksaan Medis
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formtindaklanjut()">
                            <i class="fas fa-inbox mr-2"></i>Form Rujuk internal / Konsul Antar Poli
                        </a>
                    </li>
                    <li hidden class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formtindaklanjut2()">
                            <i class="fas fa-inbox mr-2"></i>Form Rujuk internal
                        </a>
                    </li>
                    @else
                      <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="hasilpemeriksaanmedis()">
                            <i class="fas fa-inbox mr-2"></i>Hasil Pemeriksaan Medis
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan_fisio()">
                            <i class="fas fa-inbox mr-2"></i>CPPT Fisioterapi
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formtindaklanjut()">
                            <i class="fas fa-inbox mr-2"></i>Form Tindak Lanjut
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan_wicara()">
                            <i class="fas fa-inbox mr-2"></i>CPPT Terapiwicara
                        </a>
                    </li>
                    @endif
                    {{-- @if(auth()->user()->unit == '1002')
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaankhusus()">
                            <i class="fas fa-inbox mr-2"></i>Penandaan Gambar
                        </a>
                    </li>
                    @endif --}}

                     <li hidden class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="goto_suratkontrol()">
                            <i class="fas fa-inbox mr-2"></i>Buat Surat Kontrol
                        </a>
                    </li>
                    <li hidden class="nav-item">
                        <a href="#" class="nav-link" onclick="resume()">
                            <i class="fas fa-filter mr-2"></i> Resume
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="slide3">

        </div>
    </div>
    <!-- /.col -->
</div>
<style>
    .modal-xxl {
    max-width: 80%;
}
</style>
<div class="modal fade" id="modalcatatanmedis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xxl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catatan Medis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="v_catatan_medis_baru">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        rm = $('#nomorrm').val()
        formbillingtindakan()
    })
    function formcatatanmedis(rm) {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambilcatatanmedis_pasien') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formcatatanmedis3() {
        rm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('ambilcatatanmedis_pasien2') ?>',
            success: function(response) {
                $('.v_catatan_medis_baru').html(response);
                spinner.hide()
            }
        });
    }
    function formbillingtindakan() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formbillingtindakan') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formtindaklanjut() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formtindaklanjut') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formtindaklanjut2() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formtindaklanjut2') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function hasilpemeriksaanmedis() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('hasilpemeriksaanmedis') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formpemeriksaan() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formpemeriksaan_') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formpemeriksaan_fisio() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formpemeriksaan_fisio') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formpemeriksaan_wicara() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formpemeriksaan_wicara') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formpemeriksaankhusus() {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formpemeriksaan_khusus') ?>',
            success: function(response) {
                spinner.hide()
                $('.slide3').html(response);
            }
        });
    }
    function formupload() {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formupload') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formsumarilis()
    {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('formsumarilis') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formmonitoringdarah()
    {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('form_monitoring_darah') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function resume()
    {
        kodekunjungan = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan
            },
            url: '<?= route('resumepasien') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function goto_suratkontrol()
    {
        window.open("http://192.168.2.30/siramah/kunjunganPoliklinik");
    }
</script>
