<div class="card">
    <div class="card-header bg-warning">Tindak Lanjut</div>
    <div class="card-body">
        @if (!empty($resume))
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="KONSUL KE POLI LAIN"
                    @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'KONSUL KE POLI LAIN') checked @endif @endif>
                <label class="form-check-label" for="inlineRadio1">KONSUL KE POLI LAIN</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="KONTROL" @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'KONTROL') checked @endif
                    @endif>
                <label class="form-check-label" for="inlineRadio2">KONTROL</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="PASIEN DIPULANGKAN"
                    @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'PASIEN DIPULANGKAN') checked @endif @endif>
                <label class="form-check-label" for="inlineRadio2">PULANG</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="RUJUK KELUAR"
                    @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'RUJUK KELUAR') checked @endif @endif>
                <label class="form-check-label" for="inlineRadio2">RUJUK KELUAR</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="RUJUK RAWAT INAP"
                    @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'RUJUK RAWAT INAP') checked @endif @endif>
                <label class="form-check-label" for="inlineRadio2">RAWAT INAP</label>
            </div>
            <div class="form-check form-check-inline mb-2">
                <input class="form-check-input" type="radio" name="pilihtindaklanjut" id="pilihtindaklanjut"
                    value="PASIEN MENINGGAL"
                    @if (!empty($resume)) @if ($resume[0]->tindak_lanjut == 'PASIEN MENINGGAL') checked @endif @endif>
                <label class="form-check-label" for="inlineRadio2">PASIEN MENINGGAL</label>
            </div>
            <div class="form-group mt-2">
                <label for="exampleInputEmail1">Keterangan</label>
                <textarea type="text" class="form-control" id="keterangantindaklanjut" name="keterangantindaklanjut"
                    aria-describedby="emailHelp">
@if (!empty($resume)) {{ $resume[0]->keterangan_tindak_lanjut }} @endif
</textarea>
            </div>
            <button class="btn btn-success" onclick="simpantindaklanjut()">Simpan</button>
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi ...
                </h3>
                <p> Anda harus mengisi assesmen awal medis terlebih dulu ... </p>
            </div>
        @endif
    </div>
</div>
<script>
    function simpantindaklanjut() {
        pilih = $('#pilihtindaklanjut:checked').val()
        ket = $('#keterangantindaklanjut').val()
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                pilih,
                ket
            },
            url: '<?= route('simpantindaklanjut') ?>',
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
                }
                resume()
            }
        });
    }
</script>
