<div class="form-row align-items-center">
  <div class="col-sm-6 my-1">
    <label class="" for="">Nama layanan</label>
    <input type="text" class="form-control" placeholder="Ketik nama layanan" id="nl1" name="nl1">
    <input hidden type="text" class="form-control" placeholder="Ketik nama layanan" id="kodenl1" name="kodenl1">
  </div>
  <div class="col-sm-3 my-1">
    <label class="" for="">Tarif</label>
    <input readonly type="text" class="form-control" id="tl1" name="tl1">
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
    <input readonly type="text" class="form-control" id="tl1" name="tl2">
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
<div class="form-row align-items-center">
  <div class="col-sm-6 my-1">
    <label class="" for="">Nama layanan</label>
    <input type="text" class="form-control" placeholder="Ketik nama layanan" id="nl3" name="nl3">
    <input hidden type="text" class="form-control" placeholder="Ketik nama layanan" id="kodenl3" name="kodenl3">
  </div>
  <div class="col-sm-3 my-1">
    <label class="" for="">Tarif</label>
    <input readonly type="text" class="form-control" id="tl1" name="tl3">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">jlh</label>
    <input type="text" class="form-control" id="jlh3">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">disc</label>
    <input type="text" class="form-control" id="disc3">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">cyto</label>
    <input type="text" class="form-control" id="cyto3">
  </div>
</div>
<div class="form-row align-items-center">
  <div class="col-sm-6 my-1">
    <label class="" for="">Nama layanan</label>
    <input type="text" class="form-control" placeholder="Ketik nama layanan" id="nl4" name="nl4">
    <input hidden type="text" class="form-control" placeholder="Ketik nama layanan" id="kodenl4" name="kodenl4">
  </div>
  <div class="col-sm-3 my-1">
    <label class="" for="">Tarif</label>
    <input readonly type="text" class="form-control" id="tl1" name="tl4">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">jlh</label>
    <input type="text" class="form-control" id="jlh4">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">disc</label>
    <input type="text" class="form-control" id="disc4">
  </div>
  <div class="col-sm-1 my-1">
    <label class="" for="inlineFormInputName">cyto</label>
    <input type="text" class="form-control" id="cyto4">
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
                        $('[id="jlh1"]').val(1)
                    $('[id="disc1"]').val(0)
                    $('[id="cyto1"]').val(0)
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
                        $('[id="jlh2"]').val(1)
                    $('[id="disc2"]').val(0)
                    $('[id="cyto2"]').val(0)
                    }
                });
            });  
      $(document).ready(function() {
                $('#nl3').autocomplete({
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
                        $('[name="nl3"]').val(ui.item.label);
                        $('[name="kodenl3"]').val(ui.item.kode);
                        $('[name="tl3"]').val(ui.item.tarif);
                        $('[id="jlh3"]').val(1)
                    $('[id="disc3"]').val(0)
                    $('[id="cyto3"]').val(0)
                    }
                });
            });  
      $(document).ready(function() {
                $('#nl4').autocomplete({
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
                        $('[name="nl4"]').val(ui.item.label);
                        $('[name="kodenl4"]').val(ui.item.kode);
                        $('[name="tl4"]').val(ui.item.tarif);
                        $('[id="jlh4"]').val(1)
                    $('[id="disc4"]').val(0)
                    $('[id="cyto4"]').val(0)
                    }
                });
            });  
     </script>  
