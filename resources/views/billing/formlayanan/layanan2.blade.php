<div class="form-row align-items-center">
  <div class="col-sm-6 my-1">
    <label class="" for="">Nama layanan</label>
    <input type="text" class="form-control" placeholder="Ketik nama layanan" id="nl1" name="nl1">
    <input hidden type="text" class="form-control" placeholder="Ketik nama layanan" id="kodenl1" name="kodenl1">
  </div>
  <div class="col-sm-3 my-1">
    <label class="" for="">Tarif</label>
    <input type="text" class="form-control" id="tl1" name="tl1">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">jlh</label>
    <input type="text" class="form-control" id="jlh1">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">disc</label>
    <input type="text" class="form-control" id="disc1">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">cyto</label>
    <input type="text" class="form-control" id="cyto1">
  </div>
</div>
<div class="form-row align-items-center">
  <div class="col-sm-6 my-1">
    <label class="" for="">Nama layanan</label>
    <input type="text" class="form-control" placeholder="Ketik nama layanan" id="nl2" name="nl2">
    <input hidden type="text" class="form-control" placeholder="Ketik nama layanan" id="kodenl2" name="kodenl2">
  </div>
  <div class="col-sm-3 my-1">
    <label class="" for="">Tarif</label>
    <input type="text" class="form-control" id="tl1" name="tl2">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">jlh</label>
    <input type="text" class="form-control" id="jlh2">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">disc</label>
    <input type="text" class="form-control" id="disc2">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">cyto</label>
    <input type="text" class="form-control" id="cyto2">
  </div>
</div>
    <script>
      $(document).ready(function() {
                $('#nl1').autocomplete({
                    source: function(request, response) {
                        kelas = $('#kelas_unit_pasien').val()
                        $.ajax({
                            url: "<?= route('carilayanan_penunjang') ?>",
                            dataType: "json",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelas: kelas,
                                q: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        $('[name="nl1"]').val(ui.item.label);
                        $('[name="kodenl1"]').val(ui.item.kode);
                        $('[name="tl1"]').val(ui.item.tarif);
                    }
                });
            });  
      $(document).ready(function() {
                $('#nl2').autocomplete({
                    source: function(request, response) {
                        kelas = $('#kelas_unit_pasien').val()
                        $.ajax({
                            url: "<?= route('carilayanan_penunjang') ?>",
                            dataType: "json",
                            data: {
                                _token: "{{ csrf_token() }}",
                                kelas: kelas,
                                q: request.term
                            },
                            success: function(data) {
                                response(data);
                            }
                        });
                    },
                    select: function(event, ui) {
                        $('[name="nl2"]').val(ui.item.label);
                        $('[name="kodenl2"]').val(ui.item.kode);
                        $('[name="tl2"]').val(ui.item.tarif);
                    }
                });
            });  
     </script>  
