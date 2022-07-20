  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img width="100%" src="{{ asset('public/img/logo.png')}}" alt="AdminLTE Logo" class=""
              style="opacity: .8">
          {{-- <span class="brand-text font-weight-light">SEMERUSMART</span> --}}
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('public/img/logouser.png') }}" class="img-circle elevation-2" alt="User Image">
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
                  {{-- <li class="nav-item">
                      <a href="{{ route('Validasiranap') }}" class="nav-link @if($sidebar == '2.1') active @endif">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Validasi Pasien Ranap
                          </p>
                      </a>
                  </li> --}}
                  @endif
                  <li hidden class="nav-item">
                    <a href="{{ route('Billing') }}" class="nav-link @if($sidebar == '2') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Billing
                        </p>
                    </a>
                </li>
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
                                  <p>Riwayat Pelayanan</p>
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
                  <li class="nav-header">BPJS VClaim V2</li>
                  <li class="nav-item @if($sidebar== 'SEP') menu-open @endif">
                    <a href="#" class="nav-link">
                      {{-- <i class="nav-icon fas fa-table"></i> --}}
                      <i class="nav-icon fas bi bi-inboxes"></i>
                      <p>
                        SEP
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarisep')}}" class="nav-link @if($sidebar_m == 'CARI SEP') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari SEP</p>
                        </a>
                      </li>
                      {{-- <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Update Tanggal Pulang</p>
                        </a>
                      </li> --}}
                      <li class="nav-item">
                        <a href="{{ route('menulisttglpulang')}}" class="nav-link @if($sidebar_m == 'LIST TANGGAL PULANG SEP') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List Tanggal Pulang</p>
                        </a>
                      </li>
                      {{-- <li class="nav-item">
                        <a href="" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data SEP Internal</p>
                        </a>
                      </li> --}}
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List Finger Print</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item @if($sidebar== 'RUJUKAN') menu-open @endif">
                    <a href="#" class="nav-link">
                      {{-- <i class="nav-icon fas fa-table"></i> --}}
                      <i class="nav-icon fas bi bi-postcard font-weight-bold"></i>
                      <p>
                        RUJUKAN
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari Rujukan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistrujukankeluar')}}" class="nav-link text-sm @if($sidebar_m == 'DATA RUJUKAN KELUAR RS') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukankhusus')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN KHUSUS') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Khusus</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistrujukankhusus')}}" class="nav-link text-sm @if($sidebar_m == 'LIST RUJUKAN KHUSUS') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>List Rujukan Khusus</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link text-xs">
                      {{-- <i class="nav-icon fas fa-table"></i> --}}
                      <i class="nav-icon fas  bi bi-envelope-paper-fill"></i>
                      <p>
                        SURAT KONTROL & SPRI
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item text-sm">
                        <a href="{{ route('menucarisuratkontrol')}}" class="nav-link @if($sidebar_m == 'CARI SURAT KONTROL & SPRI') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari Surat Kontrol / SPRI</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrencanakontrol')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT SURAT KONTROL') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rencana Kontrol</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertspri')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT SPRI') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert SPRI</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  {{-- <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas bi bi-sliders2"></i>
                      <p>
                        REFERENSI
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari RUJUKAN</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li> --}}
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      {{-- <i class="nav-icon fas fa-table"></i> --}}
                      <i class="nav-icon fasbi bi-back"></i>
                      <p>
                        PRB
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert PRB</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari Nomor PRB</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      {{-- <i class="nav-icon fas fa-table"></i> --}}
                      <i class="nav-icon fas bi bi-tv"></i>
                      <p>
                        MONITORING
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Kunjungan</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Klaim</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>History Pelayanan Peserta </p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Klaim JR</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header">Laboratorium</li>
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Billing
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari RUJUKAN</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistrujukankeluar')}}" class="nav-link text-sm @if($sidebar_m == 'DATA RUJUKAN KELUAR RS') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-header">Bank Darah</li>
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Billing
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari RUJUKAN</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li>

                  <li class="nav-header">Poli Klinik</li>
                  <li class="nav-item @if($sidebar== 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Billing
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari RUJUKAN</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li>


{{-- 
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
                              <a href="{{ route('rujukan')}}" class="nav-link @if($sidebar_m == '4.3') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>RUJUKAN</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('vclaimreferensi') }}" class="nav-link @if($sidebar_m == '4.4') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>REFERENSI</p>
                              </a>
                          </li>
                      </ul>
                  </li> --}}
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
