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
</script>