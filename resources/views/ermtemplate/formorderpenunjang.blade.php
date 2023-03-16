<div class="card">
    <div class="card-header bg-warning">Order Penunjang</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan Penunjang</label>
                    <input type="text" id="diagnosapemeriksaanpenunjang" class="form-control">
                  </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Tanggal Pemeriksaan Penunjang</label>
                    <input type="date" id="tanggalperiksapenunjang" value="03/06/2023" class="form-control">
                  </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Pilih Unit Penunjang</label>
                    <select class="form-control" id="pilihpenunjang" onchange="pilihform()">
                      <option value="0">Silahkan Pilih</option>
                      <option value="1">Laboratorium Radiologi</option>
                      <option value="2">Laboratorium</option>
                    </select>
                  </div>
            </div>
            <div class="col-md-12">
                <div class="formnya">

                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">Riwayat Order</div>
                    <div class="card-body">
                        <div class="riwayatorder">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pilihform()
    {
        kodekunjungan = $('#kodekunjungan').val()
        id = $('#pilihpenunjang').val()
        nomorrm = $('#nomorrm').val()
        diagx = $('#diagnosapemeriksaanpenunjang').val()
        tanggalperiksa = $('#tanggalperiksapenunjang').val()
        if(diagx == ''){
            alert('Silahkan isi diagnosa ...')
        }else if(tanggalperiksa == ''){
            alert('Silahkan isi tanggal periksa ...')
        }else{
            $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kodekunjungan,
                id
            },
            url: '<?= route('ambilform') ?>',
            success: function(response) {
                $('.formnya').html(response);
            }
        });
        }
    }
    $(document).ready(function() {
            orderhari_ini()
        });
        function orderhari_ini() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan : $('#kodekunjungan').val()
                },
                url: '<?= route('orderhari_ini') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.riwayatorder').html(response)
                }
            });
        }
</script>
