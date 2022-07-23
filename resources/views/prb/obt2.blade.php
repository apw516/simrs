<div class="card">
    <div class="card-body">
        <div class="row mt-2 dokterlayan">
            <div class="col-sm-2 text-right text-bold">Pilih Obat</div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col">
                      <input type="text" id="namaobat1" class="form-control" placeholder="nama obat ..">
                      <input hidden type="text" id="kodeobat1" class="form-control" placeholder="">
                    </div>
                    <div class="col">
                        <select id="signa1_1" class="form-control">
                            <option value="1">Signa 1</option>
                            <option value="2">Signa 2</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="signa2_1" class="form-control">
                            <option value="1">Signa 1</option>
                            <option value="2">Signa 2</option>
                        </select>
                    </div>
                    <div class="col">
                      <input type="text" id="jmlhobt1" class="form-control" placeholder="jumlah obat..">
                    </div>
                  </div>
            </div>
        </div>
        <div class="row mt-2 dokterlayan">
            <div class="col-sm-2 text-right text-bold">Pilih Obat</div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col">
                      <input type="text" id="namaobat2" class="form-control" placeholder="nama obat ..">
                      <input hidden type="text" id="kodeobat2" class="form-control" placeholder="">
                    </div>
                    <div class="col">
                        <select id="signa1_2" class="form-control">
                            <option value="1">Signa 1</option>
                            <option value="2">Signa 2</option>
                        </select>
                    </div>
                    <div class="col">
                        <select id="signa2_2" class="form-control">
                            <option value="1">Signa 1</option>
                            <option value="2">Signa 2</option>
                        </select>
                    </div>
                    <div class="col">
                      <input type="text" id="jmlhobt2" class="form-control" placeholder="jumlah obat..">
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
           $('#namaobat1').autocomplete({
               source: "<?= route('cariobat') ?>",
               select: function(event, ui) {
                   $('[id="namaobat1"]').val(ui.item.label);
                   $('[id="kodeobat1"]').val(ui.item.kode);
               }
           });
       });
    $(document).ready(function() {
           $('#namaobat2').autocomplete({
               source: "<?= route('cariobat') ?>",
               select: function(event, ui) {
                   $('[id="namaobat2"]').val(ui.item.label);
                   $('[id="kodeobat2"]').val(ui.item.kode);
               }
           });
       });
</script>