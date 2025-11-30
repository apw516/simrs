<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item float-right">
            <a class="nav-link" href="{{ route('kontakkami')}}" role="button">Kontak kami</a>
        </li>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-dark" data-toggle="modal"
            data-target="#modalcetaklabel"><i class="bi bi-printer mr-1"></i> Cetak Label</button>
        </div>
        {{-- <li class="nav-item">
            <img width="4%" src="{{ asset('public/img/logo_rs.png')}}" alt="AdminLTE Logo" class="ml-2 mr-3"
            style="opacity: .8">
        </li> --}}
    </ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="modalcetaklabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cetak Label</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="form-group">
                          <label for="exampleInputEmail1">Masukan Nomor RM</label>
                          <input type="email" class="form-control" id="NOMORRMLABEL" name="NOMORRMLABEL" aria-describedby="emailHelp">
                      </div>
                  </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="cetaklabel()"><i class="bi bi-printer mr-1"></i>Cetak</button>
              </div>
          </div>
      </div>
  </div>
  <script>
    function cetaklabel()
    {
        rm = $('#NOMORRMLABEL').val()
        window.open('cetaklabel/' + rm);
    }
</script>
