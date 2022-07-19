<div class="card">
  <div class="card-body">
      <div class="row mt-2 dokterlayan">
          <div class="col-sm-4 text-right text-bold">Pilih Procedure</div>
          <div class="col-sm-8">
              <div class="row">
                  <div class="col">
                    <input type="text" id="proc1" class="form-control" placeholder="masukan nama procedure ..">
                    <input hidden type="text" id="kdproc1" class="form-control" placeholder="masukan nama procedure ..">
                  </div>
                </div>
          </div>
      </div>
      <div class="row mt-2 dokterlayan">
          <div class="col-sm-4 text-right text-bold">Pilih Procedure</div>
          <div class="col-sm-8">
              <div class="row">
                  <div class="col">
                    <input type="text" id="proc2" class="form-control" placeholder="masukan nama procedure ..">
                    <input hidden type="text" id="kdproc2" class="form-control" placeholder="masukan nama procedure ..">
                  </div>
                </div>
          </div>
      </div>
      <div class="row mt-2 dokterlayan">
          <div class="col-sm-4 text-right text-bold">Pilih Procedure</div>
          <div class="col-sm-8">
              <div class="row">
                  <div class="col">
                    <input type="text" id="proc3" class="form-control" placeholder="masukan nama procedure ..">
                    <input hidden type="text" id="kdproc3" class="form-control" placeholder="masukan nama procedure ..">
                  </div>
                </div>
          </div>
      </div>
      <div class="row mt-2 dokterlayan">
          <div class="col-sm-4 text-right text-bold">Pilih Procedure</div>
          <div class="col-sm-8">
              <div class="row">
                  <div class="col">
                    <input type="text" id="proc4" class="form-control" placeholder="masukan nama procedure ..">
                    <input hidden type="text" id="kdproc4" class="form-control" placeholder="masukan nama procedure ..">
                  </div>
                </div>
          </div>
      </div>
      <div class="row mt-2 dokterlayan">
          <div class="col-sm-4 text-right text-bold">Pilih Procedure</div>
          <div class="col-sm-8">
              <div class="row">
                  <div class="col">
                    <input type="text" id="proc5" class="form-control" placeholder="masukan nama procedure ..">
                    <input hidden type="text" id="kdproc5" class="form-control" placeholder="masukan nama procedure ..">
                  </div>
                </div>
          </div>
      </div>
  </div>
</div>
<script>
$(document).ready(function() {
       $('#proc1').autocomplete({
           source: "<?= route('cariprocedure') ?>",
           select: function(event, ui) {
               $('[id="proc1"]').val(ui.item.label);
               $('[id="kdproc1"]').val(ui.item.kode);
           }
       });
   });
$(document).ready(function() {
       $('#proc2').autocomplete({
           source: "<?= route('cariprocedure') ?>",
           select: function(event, ui) {
               $('[id="proc2"]').val(ui.item.label);
               $('[id="kdproc2"]').val(ui.item.kode);
           }
       });
   });
$(document).ready(function() {
       $('#proc3').autocomplete({
           source: "<?= route('cariprocedure') ?>",
           select: function(event, ui) {
               $('[id="proc3"]').val(ui.item.label);
               $('[id="kdproc3"]').val(ui.item.kode);
           }
       });
   });
$(document).ready(function() {
       $('#proc4').autocomplete({
           source: "<?= route('cariprocedure') ?>",
           select: function(event, ui) {
               $('[id="proc4"]').val(ui.item.label);
               $('[id="kdproc4"]').val(ui.item.kode);
           }
       });
   });
$(document).ready(function() {
       $('#proc5').autocomplete({
           source: "<?= route('cariprocedure') ?>",
           select: function(event, ui) {
               $('[id="proc5"]').val(ui.item.label);
               $('[id="kdproc5"]').val(ui.item.kode);
           }
       });
   });
</script>