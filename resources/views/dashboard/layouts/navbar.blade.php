<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item">
            <li class="nav-item float-right">
                <a class="nav-link" href="{{ route('kontakkami')}}" role="button">Kontak kami</a>
            </li>
            {{-- <img width="4%" src="{{ asset('public/img/logo_rs.png') }}" alt="AdminLTE Logo" class="ml-2 mr-3"
                style="opacity: .8"> --}}
            <div class="btn-group" role="group">
                @if (auth()->user()->unit == '3001')
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#modalinfopasienbpjs"><i class="bi bi-person-plus"></i> Info Pasien
                        BPJS</button>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#modalpengajuansep"><i class="bi bi-send-plus-fill"></i> Pengajuan SEP
                        Bckdate / Finger</button>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#modalpencarianrujukan"><i class="bi bi-send-plus-fill"></i> Cari
                        Rujukan</button>
                    {{-- <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                    data-target="#modalpencariansep"><i class="bi bi-send-plus-fill"></i> Cari
                    SEP</button> --}}
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#modalupdatetglpulang"><i class="bi bi-send-plus-fill mr-2"></i>Update tanggal
                        pulang</button>
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#modalpencariansep"><i class="bi bi-send-plus-fill"></i> Cari
                        SEP</button>
                @endif
            </div>
        </li>
    </ul>
</nav>
