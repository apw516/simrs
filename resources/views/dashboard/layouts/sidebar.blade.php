  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="{{ asset('public/img/logo_rs.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">SEMERUSMART</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('public/img/user.jpg') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ auth()->user()->username }}</a>
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
                  @if(auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 2)
                  <li class="nav-item">
                      <a href="{{ route('pendaftaran') }}" class="nav-link @if($sidebar == '2') active @endif">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Pendaftaran
                          </p>
                      </a>
                  </li>
                  @endif
                  {{-- <li class="nav-item">
                      <a href="/pendaftaran" class="nav-link @if($sidebar == '6') active @endif">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Billing Poliklinik
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="/pendaftaran" class="nav-link @if($sidebar == '6') active @endif">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Billing Laboratorium
                          </p>
                      </a>
                  </li> --}}
                  @if(auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 2)
                  <li class="nav-item @if($sidebar == '3') menu-open @endif">
                      <a href="#" class="nav-link @if($sidebar == '3') active @endif">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Riwayat Pendaftaran
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item ">
                              <a href="{{ route('riwayatpelayanan_user')}}" class="nav-link @if($sidebar_m == '3.1') active @endif ">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Riwayat Pelayanan User</p>
                              </a>
                          </li>
                          <li class="nav-item ">
                              <a href="{{ route('datakunjungan') }}" class="nav-link @if($sidebar_m == '3.2') active @endif ">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Data Kunjungan RS</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item @if($sidebar == '4') menu-open @endif">
                      <a href="#" class="nav-link @if($sidebar == '4') active @endif">
                          <i class="nav-icon fas fa-chart-pie"></i>
                          <p>
                              Vclaim 2.0
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('vclaimsep')}}" class="nav-link @if($sidebar_m == '4.1') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>SEP</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('vclaimsurakontrol')}}" class="nav-link @if($sidebar_m == '4.2') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>SURAT KONTROL</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="/simrsvclaim/surakontrol" class="nav-link @if($sidebar_m == '4.3') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>RUJUKAN</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endif
                  {{-- <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tree"></i>
                          <p>
                              Rekamedis
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="pages/UI/modals.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Modals & Alerts</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/UI/navbar.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Navbar & Tabs</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/UI/timeline.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Timeline</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="pages/UI/ribbons.html" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ribbons</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                 --}}
                  <li class="nav-header"> <i class="nav-icon bi bi-person-circle mr-2"></i> INFO AKUN</li>
                  <li class="nav-item">
                      <a href="" class="nav-link">
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
