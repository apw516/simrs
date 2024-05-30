<button class="btn btn-danger" onclick="ambildatapasien()">Kembali</button>
<div class="row mt-3">
    <div class="col-md-2">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/img/user.jpg') }}"
                        alt="User profile picture">
                </div>

                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} | {{ $mt_pasien[0]->no_rm  }}</h3>

                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-xs">Jenis Kelamin :
                    @if($mt_pasien[0]->jenis_kelamin == 'P' || $mt_pasien[0]->jenis_kelamin == 'p')
                    Perempuan
                    @elseif ($mt_pasien[0]->jenis_kelamin == 'L' || $mt_pasien[0]->jenis_kelamin == 'l')
                    Laki - Laki
                    @else
                    {{ $mt_pasien[0]->jenis_kelamin }}
                    @endif
                </p>
                <p class="text-bold text-center text-md">Diagnosa :
                    @if(count($last_assdok) > 0)
                    <br>{{ $last_assdok[0]->diagnosakerja }}</p>
                    @else
                    <br>{{ $kunjungan[0]->diagx }}</p>
                    @endif
                <a href="#" onclick="formcatatanmedis({{ $kunjungan[0]->no_rm }})" class="btn btn-primary btn-block"><b>Catatan
                        Medis</b></a>
                <input hidden type="text" id="kodekunjungan" value="{{ $kunjungan[0]->kode_kunjungan }}">
                <input hidden type="text" id="nomorrm" value="{{ $kunjungan[0]->no_rm }}">
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
                    {{-- @if($pic == auth()->user()->id || $pic == '') --}}
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaandokter2()">
                            <i class="fas fa-inbox mr-2"></i>Assesment Rawat Jalan
                        </a>
                    </li>
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaankhusus()">
                            <i class="fas fa-inbox mr-2"></i>Pemeriksaan Khusus
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="forminputtindakan()">
                            <i class="fas fa-inbox mr-2"></i>Input Tindakan
                        </a>
                    </li> --}}
                    @if(auth()->user()->unit != '1028')
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="orderpenunjang()">
                            <i class="fas fa-inbox mr-2"></i>Order Penunjang
                        </a>
                    </li> --}}
                    @endif
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="orderfarmasi()">
                            <i class="fas fa-inbox mr-2"></i>Order Farmasi
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formupload()">
                            <i class="fas fa-inbox mr-2"></i>Upload Berkas
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formtindaklanjut()">
                            <i class="fas fa-inbox mr-2"></i>Tindak Lanjut
                        </a>
                    </li> --}}
                    {{-- @endif --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="resume()">
                            <i class="fas fa-filter mr-2"></i> Resume
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-10">
        <div class="slide3">
        </div>
    </div>
    <!-- /.col -->
</div>
<script>
    $(document).ready(function() {
        rm = $('#nomorrm').val()
        formcatatanmedis(rm)
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
    function formpemeriksaandokter() {
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
            url: '<?= route('formpemeriksaan_dokter') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formpemeriksaandokter2() {
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
            url: '<?= route('v2_formpemeriksaan_dokter') ?>',
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
    function orderfarmasi() {
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
            url: '<?= route('formorderfarmasi') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function orderpenunjang() {
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
            url: '<?= route('formorderpenunjang') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function forminputtindakan() {
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
            url: '<?= route('formtindakan') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formtindaklanjut()
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
            url: '<?= route('tindaklanjut_dokter') ?>',
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
            url: '<?= route('resumepasien_dokter') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
</script>
