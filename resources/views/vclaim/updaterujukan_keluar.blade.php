<div class="container">
    <div class="card">
        <div class="card-body">
                <div class="form-group row">
                  <label for="staticEmail" class="col-sm-4 col-form-label">No Rujukan</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control-plaintext" id="norujukan_update" value="{{ $data->response->rujukan->noRujukan}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Tgl Rujukan</label>
                  <div class="col-sm-8">
                    <input type="" class="form-control-plaintext datepicker" data-date-format="yyyy-mm-dd" id="tglrujukan_update" value="{{ $data->response->rujukan->tglRujukan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Tgl Rencana Kunjungan</label>
                  <div class="col-sm-8">
                    <input class="form-control-plaintext datepicker" data-date-format="yyyy-mm-dd" id="tglrencana_update" value="{{ $data->response->rujukan->tglRencanaKunjungan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Pencarian faskes</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm" id="faskes">
                        <option value="">-- Silahkan Pilih --</option>
                        <option value="1">Faskes 1</option>
                        <option value="2">Faskes 2</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">PPK Rujukan</label>
                  <div class="col-sm-8">
                    <input type="" class="form-control-plaintext" name="namappk_update" id="namappk_update" value="{{ $data->response->rujukan->namaPpkDirujuk }}">
                    <input hidden type="" readonly class="form-control-plaintext" name="kodeppk_update" id="kodeppk_update" value="{{ $data->response->rujukan->ppkDirujuk }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Diagnosa</label>
                  <div class="col-sm-8">
                    <input type="" class="form-control-plaintext" id="namadiagnosa_update" value="{{ $data->response->rujukan->namaDiagRujukan }}">
                    <input hidden type="" class="form-control-plaintext" id="kodediagnosa_update" value="{{ $data->response->rujukan->diagRujukan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Tipe Rujukan</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm" id="tiperujukan_update">
                        <option @if($data->response->rujukan->tipeRujukan == 0 ) selected @endif value="0">Penuh</option>
                        <option @if($data->response->rujukan->tipeRujukan == 1 ) selected @endif value="1">Partial</option>
                        <option @if($data->response->rujukan->tipeRujukan == 2 ) selected @endif value="2">Balik PRB</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Pelayanan</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm" id="jenispelayanan_update">
                        <option @if($data->response->rujukan->jnsPelayanan == 1 ) selected @endif value="1">Rawat Inap</option>
                        <option @if($data->response->rujukan->jnsPelayanan == 2 ) selected @endif value="2">Rawat Jalan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Poli Rujukan</label>
                  <div class="col-sm-8">
                    <input readonly type="" class="form-control-plaintext" data-toggle="modal" data-target="#modalpilihpoli" onclick="caripoli()" id="namapoli_update" value="{{ $data->response->rujukan->namaPoliRujukan }}">
                    <input hidden type="" class="form-control-plaintext" id="kodepoli_update" value="{{ $data->response->rujukan->poliRujukan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Catatan</label>
                  <div class="col-sm-8">
                    <textarea type="password" class="form-control" id="catatan_update">{{ $data->response->rujukan->catatan }}</textarea>
                  </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalpilihpoli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-warning">
              <h5 class="modal-title" id="exampleModalLabel">Pilih Poli</h5>
              <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body ui-front">
              <div class="viewpolispesialistik">

              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary">Close</button>
          </div>
      </div>
  </div>
</div>
<script> 
$(function() {
          $(".datepicker").datepicker({
              autoclose: true,
              todayHighlight: true
          }).datepicker();
      });
  $(document).ready(function() {
        $('#namadiagnosa_update').autocomplete({
            source: "<?= route('caridiagnosa') ?>",
            select: function(event, ui) {
                $('[id="namadiagnosa_update"]').val(ui.item.label);
                $('[id="kodediagnosa_update"]').val(ui.item.kode);
            }
        });
    });
    $(document).ready(function() {
        $('#namappk_update').autocomplete({
            source: function(request, response) {
                faskes = $('#faskes').val()
                $.ajax({
                    url: "<?= route('carifaskes') ?>",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        faskes: faskes,
                        q: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('[name="namappk_update"]').val(ui.item.label);
                $('[name="kodeppk_update"]').val(ui.item.kode);
            }
        });
    });
    function caripoli()
    {
      spinner = $('#loader');
      spinner.show();
      tglrujukan = $('#tglrujukan_update').val()
      kodeppk = $('#kodeppk_update').val()
      $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                tglrujukan,
                kodeppk
            },
            url: '<?= route('caripolirujukan') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewpolispesialistik').html(response)
            }
        });
    }
</script>

