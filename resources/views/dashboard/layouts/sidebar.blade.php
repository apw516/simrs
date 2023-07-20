  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img width="100%" height="80%" src="{{ asset('public/img/LOGO2.png') }}" alt="AdminLTE Logo" class=""
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
                  <li class="nav-item @if ($sidebar == 1) menu-open @endif">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('dashboard') }}"
                                  class="nav-link @if ($sidebar_m == 1.1) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>SIMRS</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 4)
                      {{-- <li class="nav-item">
                          <a href="{{ route('indexperawat') }}"
                              class="nav-link @if ($sidebar == 'ermperawat') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  ERM Perawat
                              </p>
                          </a>
                      </li> --}}
                  @endif
                  @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 2)
                      <li class="nav-item">
                          <a href="{{ route('pendaftaran') }}"
                              class="nav-link @if ($sidebar == '2') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Pendaftaran
                              </p>
                          </a>
                      </li>
                  @endif
                  @if (auth()->user()->hak_akses == '9')
                      <li class="nav-item">
                          <a href="{{ route('datapasienranap') }}"
                              class="nav-link @if ($title == 'SIMRS - Data Pasien') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p style="font-size:12px">
                                  Data Pasien
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('datasepranap') }}"
                              class="nav-link @if ($title == 'SIMRS -SEP RAWAT INAP') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p style="font-size:12px">
                                  Data Pasien Pulang
                              </p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('menucarisep') }}"
                              class="nav-link @if ($title == 'SIMRS - CARI SEP') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p style="font-size:12px">
                                  Riwayat SEP
                              </p>
                          </a>
                      </li>
                      {{-- <li class="nav-item">
                          <a href="{{ route('menucaripasien') }}"
                              class="nav-link @if ($title == 'SIMRS - PENCARIAN PASIEN') active @endif">
                              <i class="nav-icon fas fa-th"></i>
                              <p style="font-size:12px">
                                  Buka Kunjungan
                              </p>
                          </a>
                      </li> --}}
                      {{-- <li class="nav-item">
                    <a href="{{ route('Billing') }}" class="nav-link @if ($sidebar == '2') active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p style="font-size:12px">
                            Surat Kontrol Pasca Rawat
                        </p>
                    </a>
                </li> --}}
                  @endif
                  @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 2)
                      <li class="nav-item @if ($sidebar == '3') menu-open @endif">
                          <a href="#" class="nav-link @if ($sidebar == '3') active @endif">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  Riwayat Pendaftaran
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item ">
                                  <a href="{{ route('riwayatpelayanan_user') }}"
                                      class="nav-link @if ($sidebar_m == '3.1') active @endif ">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Riwayat Pelayanan</p>
                                  </a>
                              </li>
                              <li class="nav-item ">
                                  <a href="{{ route('datakunjungan') }}"
                                      class="nav-link @if ($sidebar_m == '3.2') active @endif ">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Kunjungan RS</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('menuriwayatpasien') }}"
                              class="nav-link text-sm @if ($sidebar == 'riwayatpasien') active @endif">
                              <i class="nav-icon  bi bi-clock-history"></i>
                              <p>
                                  Riwayat Pelayanan Pasien
                              </p>
                          </a>
                      </li>
                      <li class="nav-header">BPJS VClaim V2</li>
                      <li class="nav-item @if ($sidebar == 'SEP') menu-open @endif">
                          <a href="#" class="nav-link">
                              {{-- <i class="nav-icon fas fa-table"></i> --}}
                              <i class="nav-icon fas bi bi-inboxes"></i>
                              <p class="font-weight-bold">
                                  SEP
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('menusepvalidasi') }}"
                                      class="nav-link @if ($sidebar_m == 'INSERT SEP') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert SEP</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menucarisep') }}"
                                      class="nav-link @if ($sidebar_m == 'CARI SEP') active @endif">
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
                                  <a href="{{ route('menulisttglpulang') }}"
                                      class="nav-link @if ($sidebar_m == 'LIST TANGGAL PULANG SEP') active @endif">
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
                                  <a href="{{ route('menulistfinger') }}"
                                      class="nav-link @if ($sidebar_m == 'LIST FINGER PRINT') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List Finger Print</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item @if ($sidebar == 'RUJUKAN') menu-open @endif">
                          <a href="#" class="nav-link">
                              {{-- <i class="nav-icon fas fa-table"></i> --}}
                              <i class="nav-icon fas bi bi-postcard font-weight-bold"></i>
                              <p class="font-weight-bold">
                                  RUJUKAN
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('menucarirujukan') }}"
                                      class="nav-link @if ($sidebar_m == 'CARI RUJUKAN') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Cari Rujukan</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menuinsertrujukan') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert Rujukan Keluar RS</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menulistrujukankeluar') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'DATA RUJUKAN KELUAR RS') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Rujukan Keluar RS</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menuinsertrujukankhusus') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN KHUSUS') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert Rujukan Khusus</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menulistrujukankhusus') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'LIST RUJUKAN KHUSUS') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>List Rujukan Khusus</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item @if ($sidebar == 'SURAT KONTROL') menu-open @endif">
                          <a href="#" class="nav-link text-xs">
                              {{-- <i class="nav-icon fas fa-table"></i> --}}
                              <i class="nav-icon fas  bi bi-envelope-paper-fill"></i>
                              <p class="font-weight-bold">
                                  SURAT KONTROL & SPRI
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item text-sm">
                                  <a href="{{ route('menucarisuratkontrol') }}"
                                      class="nav-link @if ($sidebar_m == 'CARI SURAT KONTROL & SPRI') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Cari Surat Kontrol / SPRI</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menuinsertrencanakontrol') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'INSERT SURAT KONTROL') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert Rencana Kontrol</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menuinsertspri') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'INSERT SPRI') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert SPRI</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      {{-- <li class="nav-item @if ($sidebar == 'SURAT KONTROL') menu-open @endif">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas bi bi-sliders2"></i>
                      <p>
                        REFERENSI
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('menucarirujukan')}}" class="nav-link @if ($sidebar_m == 'CARI RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Cari RUJUKAN</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menuinsertrujukan')}}" class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Insert Rujukan Keluar RS</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('menulistfinger')}}" class="nav-link text-sm @if ($sidebar_m == 'LIST FINGER PRINT') active @endif">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Data Rujukan Keluar RS</p>
                        </a>
                      </li>
                    </ul>
                  </li> --}}
                      <li class="nav-item @if ($sidebar == 'PRB') menu-open @endif">
                          <a href="#" class="nav-link">
                              {{-- <i class="nav-icon fas fa-table"></i> --}}
                              <i class="nav-icon fasbi bi-back"></i>
                              <p class="font-weight-bold">
                                  PRB
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('menuinsertprb') }}"
                                      class="nav-link @if ($sidebar_m == 'INSERT PRB') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Insert PRB</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menucariprb') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'CARI PRB') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Cari Nomor PRB</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <li class="nav-item @if ($sidebar == 'MONITORING') menu-open @endif">
                          <a href="#" class="nav-link">
                              {{-- <i class="nav-icon fas fa-table"></i> --}}
                              <i class="nav-icon fas bi bi-tv"></i>
                              <p class="font-weight-bold">
                                  MONITORING
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                  <a href="{{ route('menudatakunjungan') }}"
                                      class="nav-link @if ($sidebar_m == 'DATA KUNJUNGAN') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Kunjungan</p>
                                  </a>
                              </li>
                              @if (auth()->user()->hak_akses == 1)
                                  <li class="nav-item">
                                      <a href="{{ route('menudataklaim') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'DATA KLAIM') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Data Klaim</p>
                                      </a>
                                  </li>
                              @endif
                              <li class="nav-item">
                                  <a href="{{ route('menuhispelpes') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'History Pelayanan Peserta') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>History Pelayanan Peserta </p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="{{ route('menudataklaimjr') }}"
                                      class="nav-link text-sm @if ($sidebar_m == 'DATA KLAIM JR') active @endif">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>Data Klaim JR</p>
                                  </a>
                              </li>
                          </ul>
                      </li>
                      <div hidden class="menulain">
                          <li class="nav-header">Laboratorium</li>
                          <li class="nav-item @if ($sidebar == 'SURAT KONTROL') menu-open @endif">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                      Billing
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('menucarirujukan') }}"
                                          class="nav-link @if ($sidebar_m == 'CARI RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Cari RUJUKAN</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menuinsertrujukan') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Insert Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menulistrujukankeluar') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'DATA RUJUKAN KELUAR RS') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Data Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-header">Bank Darah</li>
                          <li class="nav-item @if ($sidebar == 'SURAT KONTROL') menu-open @endif">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                      Billing
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('menucarirujukan') }}"
                                          class="nav-link @if ($sidebar_m == 'CARI RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Cari RUJUKAN</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menuinsertrujukan') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Insert Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menulistfinger') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'LIST FINGER PRINT') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Data Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>

                          <li class="nav-header">Poli Klinik</li>
                          <li class="nav-item @if ($sidebar == 'SURAT KONTROL') menu-open @endif">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                      Billing
                                      <i class="fas fa-angle-left right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="{{ route('menucarirujukan') }}"
                                          class="nav-link @if ($sidebar_m == 'CARI RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Cari RUJUKAN</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menuinsertrujukan') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'INSERT RUJUKAN') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Insert Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="{{ route('menulistfinger') }}"
                                          class="nav-link text-sm @if ($sidebar_m == 'LIST FINGER PRINT') active @endif">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>Data Rujukan Keluar RS</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                      </div>
                  @endif
                  @if (auth()->user()->hak_akses == 3)
                      <li class="nav-header"></i>PENUNJANG</li>
                      <li class="nav-item">
                          <a href="{{ route('ordermasuk') }}"
                              class="nav-link @if ($sidebar_m == 6) active @endif"">
                              <i class="bi bi-bag nav-icon"></i>
                              {{-- <i class="bi bi-person-lines-fill nav-icon"></i> --}}
                              <p>ORDER MASUK</p>
                              <input hidden type="text" id="value1">
                              <input hidden type="text" id="value2">
                              <span hidden class="badge badge-danger right orderan"></span>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="" class="nav-link">
                              {{-- <i class="bi bi-person-lines-fill nav-icon"></i> --}}
                              <i class="bi bi-search  nav-icon"></i>
                              <p>CARI PASIEN</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="" class="nav-link">
                              <i class="bi bi-graph-up-arrow nav-icon"></i>
                              <p>RIWAYAT PELAYANAN</p>
                          </a>
                      </li>
                  @endif
                  @if (auth()->user()->hak_akses == 4 || auth()->user()->hak_akses == 5 || auth()->user()->hak_akses == 7 )
                      @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 4)
                          <li class="nav-item">
                              <a href="{{ route('indexperawat') }}"
                                  class="nav-link @if ($sidebar == 'ermperawat') active @endif">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>
                                      ERM Perawat
                                  </p>
                              </a>
                          </li>
                      @endif
                      @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 5)
                          <li class="nav-item">
                              <a href="{{ route('indexdokter') }}"
                                  class="nav-link @if ($sidebar == 'ermdokter') active @endif">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>
                                      ERM Dokter
                                  </p>
                              </a>
                          </li>
                      @endif
                      @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 7)
                          <li class="nav-item">
                              <a href="{{ route('indexdokter_ro') }}"
                                  class="nav-link @if ($sidebar == 'ermdokter_ro') active @endif">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>
                                      RO MATA
                                  </p>
                              </a>
                          </li>
                      @endif
                      @if (auth()->user()->hak_akses == 1 || auth()->user()->hak_akses == 4 || auth()->user()->hak_akses == 5)
                          <li class="nav-item">
                              <a href="{{ route('riwayatpemeriksaan_byrm') }}"
                                  class="nav-link @if ($sidebar == 'caripasien_resume') active @endif">
                                  {{-- <i class="nav-icon fas fa-th"></i> --}}
                                  <i class="nav-icon fas bi bi-search-heart"></i>
                                  <p>
                                      Cari Pasien
                                  </p>
                              </a>
                          </li>
                      @endif
                  @endif
                  @if (auth()->user()->nama == 'agyl')
                      <li class="nav-header"> <i class="nav-icon bi bi-person-circle mr-2"></i> ADMIN IT</li>
                      <li class="nav-item ">
                          <a href="{{ route('datauser') }}" class="nav-link @if($sidebar == 'datauser') active @endif">
                              <i class="bi bi-person-lines-fill nav-icon"></i>
                              <p>Data User</p>
                          </a>
                      </li>
                  @endif
                  @if (auth()->user()->nama == 'agyl' || auth()->user()->hak_akses == '1')
                  <li class="nav-header">REKAMEDIS</li>
                  <li class="nav-item @if ($sidebar == 'berkas_erm') menu-open @endif">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                              ERM
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('kunjungan_pasien') }}"
                                  class="nav-link @if ($sidebar_m == 'kunjungan_pasien') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Cek Berkas Scan</p>
                              </a>
                          </li>
                      </ul>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('berkas_erm') }}"
                                  class="nav-link @if ($sidebar_m == 'berkas_erm') active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Berkas ERM</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  @endif
                  <li class="nav-header"> <i class="nav-icon bi bi-person-circle mr-2"></i> INFO AKUN</li>
                  <li class="nav-item">
                      <a href="{{ route('profil') }}" class="nav-link">
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
  <script>
      //   var intervalID = setInterval(function() {
      //       reload_order();
      //       const element = document.getElementById("not");
      //       element.remove();
      //   }, 5000);

      //   function reload_order() {
      //       $.ajax({
      //           async: true,
      //           type: 'post',
      //           dataType: 'json',
      //           data: {
      //               _token: "{{ csrf_token() }}"
      //           },
      //           url: '<?= route('reloadorder') ?>',
      //           error: function(data) {
      //               Swal.fire({
      //                   icon: 'error',
      //                   title: 'Ooops....',
      //                   text: 'Sepertinya ada masalah......',
      //                   footer: ''
      //               })
      //           },
      //           success: function(data) {
      //               if (data.total > 0) {
      //                   $('.orderan').removeAttr('hidden')
      //                    var wrapper = $(".orderan"); //Fields wrapper
      //               $(wrapper).append(
      //                   '<div id="not">' + data.total + '</div>'
      //               );
      //               } else {
      //                   $('.orderan').Attr('hidden')
      //               }
      //           }
      //       });
      //   }
  </script>
