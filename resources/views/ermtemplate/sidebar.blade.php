  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img width="100%" src="{{ asset('public/img/LOGO2.png')}}" alt="AdminLTE Logo" class=""
              style="opacity: .8">
          {{-- <span class="brand-text font-weight-light">SEMERUSMART</span> --}}
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-5 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('public/img/logouser.png') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  {{-- <a href="#" class="d-block">{{ auth()->user()->nama }}</a> --}}
                  <marquee class="text-light" width="200" height="30">{{ auth()->user()->nama }}</marquee>
              </div>
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                  <li class="nav-item @if($sidebar == 1) menu-open @endif">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('dashboard') }}" class="nav-link @if($sidebar_m == 1.1) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>SIMRS</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @if(auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 4)
                  <li class="nav-item">
                    <a href="{{ route('indexperawat') }}" class="nav-link @if($sidebar == 'ermperawat') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ERM Perawat
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 5 )
                  <li class="nav-item">
                    <a href="{{ route('indexdokter') }}" class="nav-link @if($sidebar == 'ermdokter') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            ERM Dokter
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 4  || auth()->user()->hak_akses == 5 )
                  {{-- <li class="nav-item">
                    <a href="{{ route('indexpelayanandokter') }}" class="nav-link @if($sidebar == 'pelayanandokter') active @endif">
                        <i class="nav-icon fas bi bi-file-earmark-spreadsheet"></i>
                        <p>
                            Riwayat Pemeriksaan
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route('riwayatpemeriksaan_byrm') }}" class="nav-link @if($sidebar == 'caripasien_resume') active @endif">
                        {{-- <i class="nav-icon fas fa-th"></i> --}}
                        <i class="nav-icon fas bi bi-search-heart"></i>
                        <p>
                            Cari Pasien
                        </p>
                    </a>
                </li>
                @endif
                  <li class="nav-header"> <i class="nav-icon bi bi-person-circle mr-2"></i> INFO AKUN</li>
                  <li class="nav-item">
                      <a href="{{ route('profil')}}" class="nav-link  @if($sidebar == 'profil') active @endif">
                        <i class="bi bi-person-lines-fill nav-icon"></i>
                          <p>Profil</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" onclick="logout()">
                        <i class="nav-icon bi bi-box-arrow-left"></i>
                          <p>Logout</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
