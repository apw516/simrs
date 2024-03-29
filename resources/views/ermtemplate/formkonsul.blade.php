
<div class="card">
    <div class="card-header bg-dark">FORM KONSUL</div>
    <div class="card-body">
        <input hidden type="" id="jenis" name="jenis" value="{{ $jenis }}">
        <form method="post" class="formkonsulan">
            <div class="form-group">
                <label for="exampleInputEmail1">Poli Tujuan</label>
                <input style="z-index: 1600 !important;" type="text" class="form-control" id="politujuan"
                    name="politujuan" aria-describedby="emailHelp">
                <input hidden type="text" class="form-control" id="idpolitujuan" name="idpolitujuan"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Diagnosa</label>
                <input type="text" class="form-control" id="diagnosakonsul" name="diagnosakonsul"
                    value="{{ $assdok[0]->diagnosakerja }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Keterangan</label>
                <textarea type="text" class="form-control" id="keterangankonsul" name="keterangankonsul">{{ $assdok[0]->keterangan_tindak_lanjut }}</textarea>
            </div>
        </form>
        <button class="btn btn-success" onclick="simpankonsul()">Simpan</button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#politujuan').autocomplete({
            source: "<?= route('caripoli_konsul') ?>",
            select: function(event, ui) {
                spinner.show();
                $('[id="politujuan"]').val(ui.item.label);
                $('[id="idpolitujuan"]').val(ui.item.kode);
                spinner.hide();
            }
        });
    });

    function simpankonsul() {
        var data = $('.formkonsulan').serializeArray();
        jenis = $('#jenis').val()
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                jenis,
                kodekunjungan
            },
            url: '<?= route('simpankonsul') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                    formtindaklanjut()
                }
            }
        });
    }
</script>
