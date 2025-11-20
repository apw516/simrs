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

                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} |
                    {{ $mt_pasien[0]->no_rm }}</h3>

                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-xs">Jenis Kelamin :
                    @if ($mt_pasien[0]->jenis_kelamin == 'P' || $mt_pasien[0]->jenis_kelamin == 'p')
                        Perempuan
                    @elseif ($mt_pasien[0]->jenis_kelamin == 'L' || $mt_pasien[0]->jenis_kelamin == 'l')
                        Laki - Laki
                    @else
                        {{ $mt_pasien[0]->jenis_kelamin }}
                    @endif
                </p>
                <p class="text-bold text-center text-md">Diagnosa :
                    @if (count($last_assdok) > 0)
                        <br>{{ $last_assdok[0]->diagnosakerja }}
                </p>
            @else
                <br>{{ $kunjungan[0]->diagx }}</p>
                @endif
                {{-- <a href="#" onclick="formcatatanmedis({{ $kunjungan[0]->no_rm }})"
                    class="btn btn-primary btn-block"><b>Catatan
                        Medis</b></a> --}}
                <a href="#" class="btn btn-primary btn-block lihatcppt2" rm="{{ $kunjungan[0]->no_rm }}"><b>CPPT</b></a>
                <a href="#" class="btn btn-primary btn-block" onclick="formcatatanmedis({{ $kunjungan[0]->no_rm }})" rm="{{ $kunjungan[0]->no_rm }}"><b>Riwayat Kunjungan</b></a>
                <a href="#" onclick="lihaticare()" class="btn btn-success btn-block"><b>Icare BPJS</b></a>
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
                    @if ($pic == auth()->user()->id || $pic == '')
                        @if (auth()->user()->unit == '1029' || auth()->user()->unit == '1045')
                            <li class="nav-item" id="pemeriksaan">
                                <a href="#" class="nav-link" onclick="riwayatsumarilis()">
                                    <i class="fas fa-inbox mr-2"></i>Riwayat Sumarilis
                                </a>
                            </li>
                        @endif
                        <li class="nav-item" id="pemeriksaan" @if(auth()->user()->unit == '1046') hidden @endif>
                            <a href="#" class="nav-link" onclick="formpemeriksaandokter()">
                                <i class="fas fa-inbox mr-2"></i>Catatan Perkembangan Pasien Terintegrasi ( CPPT )
                            </a>
                        </li>
                        @if(auth()->user()->unit == '1046')
                        <li class="nav-item" id="pemeriksaan">
                            <a href="#" class="nav-link" onclick="pengkajiannyeri()">
                                <i class="fas fa-inbox mr-2"></i>PENGKAJIAN NYERI ACUTE/ CHRONIC/CANCER
                            </a>
                        </li>
                        @endif
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
                        @if (auth()->user()->unit != '1028')
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
                    @endif
                    @if(auth()->user()->unit == 1014)
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="laporanoperasi()">
                            <i class="fas fa-filter mr-2"></i> Laporan Operasi
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="resume2()">
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
        @if ($selisih > 70)
            <div class="alert alert-warning" role="alert">
                @if (count($kunjunganKronis) > 0)
                    Pasien Kronis ,
                @endif Pasien Berpotensi PRB, dan melanjutkan pengobatan kembali ke faskes 1...
                <b>( Abaikan pesan ini jika diagnosa pasien tidak termasuk 9 diagnosa PRB ...)</b>
            </div>
        @endif
        {{-- @elseif($selisih == 3)
        <div class="alert alert-warning" role="alert">
            @if (count($kunjunganKronis) > 0)
                Pasien Kronis ,
            @endif Pasien PRB, dan melanjutkan pengobatan kembali ke faskes 1...
          </div>
        @endif --}}
        <div class="card" id="icareshow">
            <div class="card-header">Icare BPJS <button class="btn btn-danger float-right" onclick="tutupicare()"><i
                        class="bi bi-x mr-1 ml-1"></i> Tutup</button>
            </div>
            <div class="card-body">
                <iframe src="{{ $urlicare }}" frameborder="0" width="100%" height="1000px%"></iframe>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger" onclick="tutupicare()"><i class="bi bi-x mr-1 ml-1"></i> Tutup</button>
            </div>
        </div>
        <div class="warning catatankonsul">
            
        </div>       
        <div hidden class="slide3">

        </div>
    </div>
    <!-- /.col -->
</div>
<!-- Modal -->
<div class="modal fade" id="modalcppt2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Catatan Perkembangan Pasien Terintegrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_cppt_2">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<input hidden type="text" id="statuslihatcppt2" value="0">
<script>
    $(document).ready(function() {
        rm = $('#nomorrm').val()
        formcatatanmedis(rm)
        catatankonsul()
    })
    function catatankonsul()
    {
        rm = $('#nomorrm').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,kodekunjungan
            },
            url: '<?= route('formcatatankonsul') ?>',
            success: function(response) {
                $('.catatankonsul').html(response);
                spinner.hide()
            }
        });
    }
    $(".lihatcppt2").click(function() {
        status = $('#statuslihatcppt2').val()
        // if (status == 0) {
            status = $('#statuslihatcppt2').val(1)
            rm = $(this).attr('rm')
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm
                },
                url: '<?= route('lihatcppt_pasien2') ?>',
                success: function(response) {
                    $('.slide3').html(response);
                    spinner.hide()
                }
            });
        // }
    })
    function tutupicare() {
        $('#icareshow').attr('Hidden', true)
        $('.slide3').removeAttr('Hidden', true)
    }
    function lihaticare() {
        $('#icareshow').removeAttr('Hidden', true)
        $('.slide3').attr('Hidden', true)
    }
    function laporanoperasi() {
        rm = $('#nomorrm').val()
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,kodekunjungan
            },
            url: '<?= route('formlaporanoperasimata') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formcatatanmedis2(rm) {
        rm = $('#nomorrm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm
            },
            url: '<?= route('lihatcppt_pasien2') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function formcatatanmedis(rm) {
        rm = $('#nomorrm').val()
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
    function pengkajiannyeri() {
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
            url: '<?= route('formpengkajiannyeri') ?>',
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
    function formtindaklanjut() {
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
    function resume() {
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
    function resume2() {
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
            url: '<?= route('resumepasien_dokter2') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
    function riwayatsumarilis() {
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
            url: '<?= route('riwayatsumarilis') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
</script>
