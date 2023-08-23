  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
      <strong>Copyright &copy; 2022 <a href="">semerusmartwaled</a>.</strong> All rights
      reserved.
      <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 1.1.0-apw
      </div>
  </footer>
  <!-- Modal -->
  <div class="modal fade" id="detailkunjungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="viewdetailkunjungan"></div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Detail SEP</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="viewdetailsep"></div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modaleditsep" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update SEP</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="viewupdatesep">
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="simpanupdate()">Update</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modalupdatetglpulang" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Update Tanggal Pulang</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{-- <div class="formupdate_tgl_pulang"> --}}
                  <form>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nomor SEP</label>
                          <input class="form-control" id="pulang_nomorsep">
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Status pulang</label>
                          <select class="form-control" id="status_pulang" onchange="gantistatuspulang()">
                              <option value="1">Atas Persetujuan Dokter</option>
                              <option value="3">Atas Permintaan sendiri</option>
                              <option value="4">Meninggal </option>
                              <option value="5">Lain-lain</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Tanggal pulang</label>
                          <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                              id="pulang_tanggal">
                      </div>
                      <div hidden id="formmeninggal">
                          <div class="form-group">
                              <label for="exampleInputPassword1">Tanggal meninggal</label>
                              <input type="text" class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                  id="tanggal_meninggal" value="">
                          </div>
                          <div class="form-group">
                              <label for="exampleInputPassword1">Nomor Surat Meninggal</label>
                              <input type="text" class="form-control" id="surat_meninggal">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Nomor LP Manual</label>
                          <input type="text" class="form-control" id="nomor_lp_manual">
                          <small id="emailHelp" class="form-text text-muted">Diisi jika sep KLL.</small>
                      </div>
                  </form>
                  {{-- </div> --}}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="simpanupdatepulang()">Simpan</button>
              </div>
          </div>
      </div>
  </div>
  </div>
  <div class="modal fade" id="modalpengajuansep" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-danger">
                  <h5 class="modal-title" id="exampleModalLabel">Pengajuan SEP backdate / finger </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Nomor Kartu</label>
                                  <input class="form-control" id="nomorkartu_pengajuan"
                                      placeholder="masukan nomor kartu ...">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Tgl SEP</label>
                                  <input class="form-control datepicker" data-date-format="yyyy-mm-dd"
                                      id="tglsep_pengajuan" aria-describedby="emailHelp"
                                      placeholder="masukan tanggal...">
                              </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jenis pelayanan</label>
                                  <select class="form-control" id="jenispelayanan">
                                      <option value="1">Rawat Inap</option>
                                      <option value="2" selected>Rawat Jalan</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="exampleInputEmail1">Jenis pengajuan</label>
                                  <select class="form-control" id="jenispengajuan">
                                      <option value="1">SEP Backdate</option>
                                      <option value="2" selected>Finger print</option>
                                  </select>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="exampleInputEmail1">Keterangan</label>
                          <textarea class="form-control" id="keteranganpengajuan" aria-describedby="emailHelp"></textarea>
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="kirimpengajuan()">Kirim</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="modaleditsuratkontrol" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog  modal-md">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Edit Surat Kontrol / SPRI </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Jenis Surat</label>
                      <select class="form-control" id="editjenissurat">
                          <option value="1">SPRI</option>
                          <option value="2">SURAT KONTROL</option>
                      </select>
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Tanggal Kontrol</label>
                      <input type="" class="form-control datepicker" id="edittanggalkontrol"
                          placeholder="name@example.com" data-date-format="yyyy-mm-dd">
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Nomor Kartu</label>
                      <input type="" class="form-control" id="editnomorkartukontrol" value=""
                          placeholder="name@example.com">
                      <input hidden type="" class="form-control" id="editnomorsurat" value=""
                          placeholder="name@example.com">
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Poli Kontrol</label>
                      <div class="input-group mb-3">
                          <input readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                              id="editpolikontrol">
                          <input hidden readonly type="text" class="form-control" placeholder="Klik cari poli ..."
                              id="editkodepolikontrol">
                          <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                  data-target="#modalpilihpoli" onclick="caripolikontrol()">Cari Poli</button>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="exampleFormControlInput1">Dokter</label>
                      <div class="input-group mb-3">
                          <input readonly type="text" class="form-control" placeholder="Klik cari dokter ..."
                              id="editdokterkontrol">
                          <input hidden readonly type="text" class="form-control"
                              placeholder="Klik cari dokter ..." id="editkodedokterkontrol">
                          <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                  data-target="#modalpilihdokter" onclick="caridokterkontrol()">Cari Dokter</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-primary" onclick="updatesuratkontrol()">Simpan</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalpilihpoli" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Pilih Poli</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body vpolikontrol">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalpilihdokter" data-backdrop="static" data-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Pilih Dokter</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body vdokterkontrol">
                  ...
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="editpasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel">Edit pasien</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="update_mtpasien()">Update</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modaldetailpasien" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h5 class="modal-title" id="exampleModalLabel">Info pasien</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="view_detail_pasien">

                  </div>
              </div>

          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modals_datarujukan" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h5 class="modal-title" id="exampleModalLabel">List Rujukan Peserta</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="viewlistrujukan">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalinfopasienbpjs" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header bg-info">
                  <h5 class="modal-title" id="exampleModalLabel">Info Pasien BPJS</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" id="nomorkartupencarian" class="form-control" placeholder="Masukan nomor Kartu BPJS ..."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-addon2" onclick="cariinfopasienbpjs()">Info Pasien</button>
                            </div>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="viewinfopasien">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalpencarianrujukan" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-primary">
                  <h5 class="modal-title" id="exampleModalLabel">Pencarian Rujukan ...</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="pencariannomor_rujukan" placeholder="Masukan nomor rujukan ..."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-addon2" onclick="yukcarirujukan()">Cari Rujukan</button>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="detailinforujukan">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalpencariansep" tabindex="-1" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header bg-warning">
                  <h5 class="modal-title" id="exampleModalLabel">Pencarian SEP ...</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body ui-front">
                  <div class="container">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="nomorseppencarian" placeholder="Masukan nomor SEP ..."
                                aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button"
                                    id="button-addon2" onclick="yukcarisep()">Cari Sep</button>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="viewinfoSEP">

                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ asset('public/dist/js/jquery-3.js') }}"></script>
  <script src="{{ asset('public/dist/js/jquery-ui.min.js') }}"></script>
  {{-- <script src="{{ asset('public/plugins/jquery/jquery.min.js"></script> --}}
  <!-- Bootstrap -->
  <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('public/dist/js/adminlte.js') }}"></script>

  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="{{ asset('public/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
  <script src="{{ asset('public/plugins/raphael/raphael.min.js') }}"></script>
  <script src="{{ asset('public/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
  <script src="{{ asset('public/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('public/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- datatable -->
  <script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('public/plugins/jszip/jszip.min.js') }}"></script>
  <script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js') }}"></script>
  <script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('public/dist/js/bootstrap-datepicker.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('public/dist/js/demo.js') }}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script>
      $(function() {
          $(".datepicker").datepicker({
              autoclose: true,
              todayHighlight: true
          }).datepicker('update', new Date());
      });
      $(".preloader").fadeOut();
      $(function() {
          $("#tabelpasienbaru").DataTable({
              "responsive": true,
              "lengthChange": false,
              "autoWidth": true,
              "pageLength": 5,
              "order": [
                  [1, "desc"]
              ]
          })
      });
      $('#tabelpasienbaru').on('click', '.daftarranap', function() {
          spinner = $('#loader')
          spinner.show();
          nomorrm = $(this).attr('rm')
          nama = $(this).attr('nama')
          if (nomorbpjs == '' || nomorbpjs == '0') {
              spinner.hide()
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops,silahkan coba lagi',
                  text: 'Nomor Kartu Belum diisi ...'
              })
          } else {
              $.ajax({
                  type: 'post',
                  data: {
                      _token: "{{ csrf_token() }}",
                      nomorrm
                  },
                  url: '<?= route('formranap') ?>',
                  error: function(data) {
                      spinner.hide()
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops,silahkan coba lagi',
                      })
                  },
                  success: function(response) {
                      spinner.hide()
                      $('.formpasien').html(response)
                  }
              });
          }
      });
      $('#tabelpasienbaru').on('click', '.daftarbpjs', function() {
          spinner = $('#loader')
          spinner.show();
          nomorrm = $(this).attr('rm')
          nomorbpjs = $(this).attr('noka')
          if (nomorbpjs == '' || nomorbpjs == '0') {
              spinner.hide()
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops,silahkan coba lagi',
                  text: 'Nomor Kartu Belum diisi ...'
              })
          } else {
              $.ajax({
                  type: 'post',
                  data: {
                      _token: "{{ csrf_token() }}",
                      nomorrm,
                      nomorbpjs
                  },
                  url: '<?= route('formbpjs') ?>',
                  error: function(data) {
                      spinner.hide()
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops,silahkan coba lagi',
                      })
                  },
                  success: function(response) {
                      spinner.hide()
                      $('.formpasien').html(response)
                  }
              });
          }
      });
      $('#tabelpasienbaru').on('click', '.daftarumum', function() {
          spinner = $('#loader')
          spinner.show();
          nomorrm = $(this).attr('rm')
          nama = $(this).attr('nama')
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nomorrm,
              },
              url: '<?= route('formumum') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.formpasien').html(response)
                  $('#namapasien').val(nama)
                  $('#nomorrm').val(nomorrm)
              }
          });
      });
      $('#tabelpasienbaru').on('click', '.editpasien', function() {
          nomorrm = $(this).attr('rm')
          nama = $(this).attr('namapasien_edit')
          nomorktp = $(this).attr('nomorktp_edit')
          nomorbpjs = $(this).attr('nomorbpjs_edit')
          $('#namapasien_edit').val(nama)
          $('#nomor_rm_edit').val(nomorrm)
          $('#nomorktp_edit').val(nomorktp)
          $('#nomorbpjs_edit').val(nomorbpjs)
      });
      $('#tabelpasienbaru').on('click', '.detailpasien', function() {
          nomorrm = $(this).attr('norm')
          spinner = $('#loader')
          spinner.show();
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nomorrm,
              },
              url: '<?= route('detailpasien') ?>',
              error: function(data) {
                  spinner.hide();
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide();
                  $('.view_detail_pasien').html(response)
                  // $('#daftarpxumum').attr('disabled', true);
              }
          })
      });

      function update_mtpasien() {
          nama = $('#namapasien_edit').val()
          rm = $('#nomor_rm_edit').val()
          ktp = $('#nomorktp_edit').val()
          bpjs = $('#nomorbpjs_edit').val()
          if (bpjs == '') {
              bpjs = '0'
          }
          $.ajax({
              dataType: 'Json',
              async: true,
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nama,
                  rm,
                  ktp,
                  bpjs
              },
              url: '<?= route('updatepasien') ?>',
              error: function(data) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(data) {
                  Swal.fire({
                      icon: 'success',
                      title: 'Update data pasien berhasil',
                  })
                  location.reload()
                  // $('#daftarpxumum').attr('disabled', true);
              }
          })
      }

      function caripolikontrol() {
          spinner = $('#loader');
          spinner.show();
          jenis = $('#jenissurat').val()
          nomor = $('#nomorkartukontrol').val()
          tanggal = $('#tanggalkontrol').val()
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

      function caridokterkontrol() {
          spinner = $('#loader');
          spinner.show();
          jenis = $('#jenissurat').val()
          kodepoli = $('#kodepolikontrol').val()
          tanggal = $('#tanggalkontrol').val()
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

      function updatesuratkontrol() {
          spinner = $('#loader');
          spinner.show();
          nomorsurat = $('#editnomorsurat').val()
          nomorkartu = $('#editnomorkartukontrol').val()
          jenissurat = $('#editjenissurat').val()
          tanggalkontrol = $('#edittanggalkontrol').val()
          polikontrol = $('#editpolikontrol').val()
          kodepolikontrol = $('#editkodepolikontrol').val()
          dokterkontrol = $('#editdokterkontrol').val()
          kodedokterkontrol = $('#editkodedokterkontrol').val()
          $.ajax({
              async: true,
              dataType: 'Json',
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nomorsurat,
                  nomorkartu,
                  jenissurat,
                  tanggalkontrol,
                  kodepolikontrol,
                  kodedokterkontrol
              },
              url: '<?= route('updatesuratkontrol') ?>',
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

      function caripasien() {
          spinner = $('#loader')
          spinner.show();
          nomorrm = $('#cari_nomorrm').val();
          nomorktp = $('#cari_nomorktp').val();
          nama = $('#cari_namapasien').val();
          nomorbpjs = $('#cari_nomorbpjs').val();
          alamat = $('#cari_alamat').val();
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nomorrm,
                  nomorktp,
                  nomorbpjs,
                  nama,
                  alamat
              },
              url: '<?= route('caripasien') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.vpasien').html(response)
              }
          });
      }

      function gantistatuspulang() {
          status = $('#status_pulang').val()
          if (status == 4) {
              $('#formmeninggal').removeAttr('hidden', true)
          } else {
              $('#formmeninggal').attr('hidden', true)
          }
      }

      function simpanupdatepulang() {
          spinner = $('#loader');
          spinner.show();
          sep = $('#pulang_nomorsep').val()
          status = $('#status_pulang').val()
          tanggalpulang = $('#pulang_tanggal').val()
          tanggalmeninggal = $('#tanggal_meninggal').val()
          suratmeninggal = $('#surat_meninggal').val()
          nomorlp = $('#nomor_lp_manual').val()
          if (status != 4) {
              tanggalmeninggal = ''
              suratmeninggal = ''
          }
          $.ajax({
              async: true,
              dataType: 'Json',
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  sep,
                  status,
                  tanggalpulang,
                  tanggalmeninggal,
                  suratmeninggal,
                  nomorlp
              },
              url: '<?= route('vclaimupdatepulang') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(data) {
                  spinner.hide()
                  if (data.metaData.code == 200) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Pasien dipulangkan ...',
                      })
                      //   location.reload()
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: data.metaData.message
                      })
                  }
              }
          });
      }

      function simpanupdate() {
          spinner = $('#loader');
          spinner.show();
          sep = $('#sep_update').val()
          rm = $('#nomorm_update').val()
          hakkelas = $('#hakkelas_update').val()
          kelasnaik = $('#kelasnaik_update').val()
          pembiayaan = $('#pembiayaan_update').val()
          penanggung = $('#penanggungjawab_update').val()
          politujuan = $('#editpolitujuan').val()
          kodepoli = $('#editkodepolitujuan').val()
          diagnosa = $('#diagnosa').val()
          kodediagnosa = $('#kodediagnosa').val()
          ekspoli = $('#polieks').val()
          cob = $('#cob').val()
          katarak = $('#katarak').val()
          statuslaka = $('#statuslaka').val()
          tgllaka = $('#tgllaka').val()
          ketlaka = $('#ketlaka').val()
          dokter = $('#namadokterlayan2').val()
          kodedokter = $('#kodedokterlayan2').val()
          sepsuplsei = $('#sepsuplesi').val()
          prov = $('#updateprovlaka').val()
          kab = $('#updatekablaka').val()
          kec = $('#updatekeclaka').val()
          nomortelp = $('#nomortelpupdate').val()
          $.ajax({
              async: true,
              dataType: 'Json',
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  sep,
                  rm,
                  hakkelas,
                  kelasnaik,
                  pembiayaan,
                  penanggung,
                  politujuan,
                  kodepoli,
                  kodediagnosa,
                  ekspoli,
                  cob,
                  katarak,
                  statuslaka,
                  tgllaka,
                  ketlaka,
                  dokter,
                  kodedokter,
                  sepsuplsei,
                  prov,
                  kab,
                  kec,
                  nomortelp,
              },
              url: '<?= route('vclaimupdatesep') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(data) {
                  spinner.hide()
                  if (data.metaData.code == 200) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil update',
                      })
                      location.reload()
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: data.metaData.message
                      })
                  }
              }
          });
      }

      function carisep() {
          nomorsep = $('#pencariansep').val()
          spinner = $('#loader')
          spinner.show();
          // nomorsep = $(this).attr('nomorsep')
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nomorsep,
              },
              url: '<?= route('vclaimupdate') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.viewupdatesep').html(response)
              }
          });
      };

      function carirujukan_bycard() {
          noka = $('#pencarianrujukan').val()
          spinner = $('#loader')
          spinner.show();
          // nomorsep = $(this).attr('nomorsep')
          $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  noka,
              },
              url: '<?= route('vclaimcarirujukankartu') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.viewlistrujukan').html(response)
              }
          });
      };

      function kirimpengajuan() {
          spinner = $('#loader')
          spinner.show()
          noka = $('#nomorkartu_pengajuan').val()
          tgl = $('#tglsep_pengajuan').val()
          jenispelayanan = $('#jenispelayanan').val()
          jenispengajuan = $('#jenispengajuan').val()
          keterangan = $('#keteranganpengajuan').val()
          $.ajax({
              async: true,
              dataType: 'Json',
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  noka,
                  tgl,
                  jenispelayanan,
                  jenispengajuan,
                  keterangan
              },
              url: '<?= route('vclaimpengajuansep') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(data) {
                  spinner.hide()
                  if (data.metaData.code == 200) {
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil kirim ...',
                      })
                      location.reload()
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: data.metaData.message
                      })
                  }
              }
          });
      }

      function logout() {
          Swal.fire({
              title: 'Logout',
              text: "Apakah anda ingin logout ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d5',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya',
              cancelButtonText: 'Tidak'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "<?= route('logout') ?>";
              }
          })
      }

      function pencarianrujukan() {
          alert('Masih dalam pengembangan ....')
          //  nomorrujukan = $('#carinomorrujukan').val()
          //  $.ajax({
          //       type: 'post',
          //       data: {
          //           _token: "{{ csrf_token() }}",
          //           nomorrujukan,
          //       },
          //       url: '<?= route('carirujukan_nomor') ?>',
          //       error: function(data) {
          //           spinner.hide()
          //           Swal.fire({
          //               icon: 'error',
          //               title: 'Oops,silahkan coba lagi',
          //           })
          //       },
          //       success: function(response) {
          //           spinner.hide()
          //           $('.hasilpencarianrujukan').html(response)
          //       }
          //   });
      }
      function cariinfopasienbpjs()
      {
        spinner = $('#loader')
        spinner.show()
        noka = $('#nomorkartupencarian').val()
        $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  noka,
              },
              url: '<?= route('cariinfopasienbpjs') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.viewinfopasien').html(response)
              }
          });
      }
      function yukcarisep()
      {
        spinner = $('#loader')
        spinner.show()
        nosep = $('#nomorseppencarian').val()
        $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  nosep,
              },
              url: '<?= route('cariinfoseppasien') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.viewinfoSEP').html(response)
              }
          });
      }
      function yukcarirujukan()
      {
        spinner = $('#loader')
        spinner.show()
        norujukan = $('#pencariannomor_rujukan').val()
        $.ajax({
              type: 'post',
              data: {
                  _token: "{{ csrf_token() }}",
                  norujukan,
              },
              url: '<?= route('cariinforujukanpasien') ?>',
              error: function(data) {
                  spinner.hide()
                  Swal.fire({
                      icon: 'error',
                      title: 'Oops,silahkan coba lagi',
                  })
              },
              success: function(response) {
                  spinner.hide()
                  $('.detailinforujukan').html(response)
              }
          });
      }
  </script>
  </body>

  </html>
