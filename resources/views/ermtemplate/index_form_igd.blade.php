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

                <h3 class="text-bold profile-username text-center text-md">{{ $mt_pasien[0]->nama_px }} |
                    {{ $mt_pasien[0]->no_rm }}</h3>

                <p class="text-bold text-center text-xs"></p>
                <p class="text-bold text-center text-xs">,
                    {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->format('Y-m-d') }}
                    (Usia {{ \Carbon\Carbon::parse($mt_pasien[0]->tgl_lahir)->age }})</p>
                <p class="text-bold text-center text-xs">Alamat : {{ $mt_pasien[0]->alamatpasien }} </p>
                <p class="text-bold text-center text-md">Diagnosa :

                    <a href="#" onclick="" class="btn btn-primary btn-block"><b>Catatan
                            Medis</b></a>
                    <input hidden type="text" id="kodekunjungan" value="">
                    <input hidden type="text" id="id_antrian" value="{{ $id_antrian }}">
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
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan()">
                            <i class="fas fa-inbox mr-2"></i>Catatan Perkembangan Pasien Terintegrasi ( CPPT )
                        </a>
                    </li>
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formtindaklanjut()">
                            <i class="fas fa-inbox mr-2"></i>Form Tindak Lanjut
                        </a>
                    </li>
                    @else
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan_fisio()">
                            <i class="fas fa-inbox mr-2"></i>CPPT Fisioterapi
                        </a>
                    </li>
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaan_wicara()">
                            <i class="fas fa-inbox mr-2"></i>CPPT Terapiwicara
                        </a>
                    </li> --}}
                    {{-- @if (auth()->user()->unit == '1002')
                    <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formpemeriksaankhusus()">
                            <i class="fas fa-inbox mr-2"></i>Penandaan Gambar
                        </a>
                    </li>
                    @endif --}}
                    {{-- <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="formupload()">
                            <i class="fas fa-inbox mr-2"></i>Upload Berkas
                        </a>
                    </li>
                     <li class="nav-item" id="pemeriksaan">
                        <a href="#" class="nav-link" onclick="goto_suratkontrol()">
                            <i class="fas fa-inbox mr-2"></i>Buat Surat Kontrol
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link" onclick="resume()">
                            <i class="fas fa-filter mr-2"></i> Resume
                        </a>
                    </li> --}}
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="slide3">

        </div>
    </div>
    <!-- /.col -->
</div>
<script>
    function formpemeriksaan() {
        spinner = $('#loader')
        spinner.show();
        id = $('#id_antrian').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('formpemeriksaan_igd') ?>',
            success: function(response) {
                $('.slide3').html(response);
                spinner.hide()
            }
        });
    }
</script>
