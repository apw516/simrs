<form action="" class="form_header">
<div class="row">
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Diagnosa</label>
                <input type="text" class="form-control" id="diagnosa" name="diagnosa" aria-describedby="emailHelp"
                    value="">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Tindakan</label>
                <input type="text" class="form-control" id="tindakan" name="tindakan" aria-describedby="emailHelp"
                    value="">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Bagian</label>
                <input type="text" class="form-control" id="bagian" name="bagian" aria-describedby="emailHelp"
                    value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam Mulai Operasi</label>
                <input type="text" class="form-control" id="jam_mulai_operasi" name="jam_mulai_operasi"
                    aria-describedby="emailHelp" value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Tanggal Operasi</label>
                <input type="date" class="form-control" id="tanggal_operasi" name="tanggal_operasi"
                    aria-describedby="emailHelp" value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Saturasi</label>
                <input type="text" class="form-control" id="saturasi" name="saturasi" aria-describedby="emailHelp"
                    value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">kesadaran</label>
                <input type="text" class="form-control" id="kesadaran" name="kesadaran" aria-describedby="emailHelp"
                    value="">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group font-italic">
                <label for="exampleInputEmail1">Jam selsesai operasi</label>
                <input type="text" class="form-control" id="jam_selesai_oprasi" name="jam_selesai_oprasi"
                    aria-describedby="emailHelp" value="">
            </div>
        </div>
    </div>
</form>
<div class="row">
    <div class="col-md-5">
        <button class="btn btn-success" onclick="simpanheader_pemantauan()">SIMPAN</button>
    </div>
</div>
<div class="v_pemantuan_anestesi_lokal">

</div>
<script>
    $(document).ready(function() {
        ambil_hasil_pemantauan()
    });
    function simpanheader_pemantauan() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.form_header').serializeArray();
        kodekunjungan = $('#kode_kunjungan').val()
        rm = $('#rm').val()
        politujuan = $('#politujuan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                rm,
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanheader_pemantauan') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: 'ermwaled2023'
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == '502') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops',
                        text: data.message,
                        footer: 'ermwaled2023'
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: 'ermwaled2023'
                    })
                    ambil_hasil_pemantauan()
                }
            }
        });
    }
    function ambil_hasil_pemantauan() {
        kode_kunjungan = $('#kode_kunjungan').val()
        nomorrm = $('#rm').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nomorrm,
                kode_kunjungan
            },
            url: '<?= route('ambil_hasil_pemantauan') ?>',
            success: function(response) {
                $('.v_pemantuan_anestesi_lokal').html(response);
                spinner.hide()
            }
        });
    }
</script>
