<div class="card">
    <div class="card-body">
        <div class="row mt-2 dokterlayan">
            <div class="col-sm-4 text-right text-bold">Pilih Diagnosa</div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col">
                        <select id="s_diag1" class="form-control">
                            <option value="P">Primer</option>
                            <option value="S">Sekunder</option>
                          </select>
                    </div>
                    <div class="col">
                      <input type="text" id="namadiag_rk1" class="form-control" placeholder="nama diagnosa ..">
                      <input hidden type="text" id="kodediag_rk1" class="form-control" placeholder="">                    </div>
                  </div>
            </div>
        </div>
        <div class="row mt-2 dokterlayan">
            <div class="col-sm-4 text-right text-bold">Pilih Diagnosa</div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col">
                        <select id="s_diag2" class="form-control">
                            <option value="P">Primer</option>
                            <option value="S">Sekunder</option>
                          </select>
                    </div>
                    <div class="col">
                      <input type="text" id="namadiag_rk2" class="form-control" placeholder="nama diagnosa ..">
                      <input hidden type="text" id="kodediag_rk2" class="form-control" placeholder="">                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<script>
  $(document).ready(function() {
         $('#namadiag_rk1').autocomplete({
             source: "<?= route('caridiagnosa') ?>",
             select: function(event, ui) {
                 $('[id="namadiag_rk1"]').val(ui.item.label);
                 $('[id="kodediag_rk1"]').val(ui.item.kode);
             }
         });
     });
  $(document).ready(function() {
         $('#namadiag_rk2').autocomplete({
             source: "<?= route('caridiagnosa') ?>",
             select: function(event, ui) {
                 $('[id="namadiag_rk2"]').val(ui.item.label);
                 $('[id="kodediag_rk2"]').val(ui.item.kode);
             }
         });
     });
</script>