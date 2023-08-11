<div class="card">
    <div class="card-header bg-warning">FORM SUMARILIS</div>
    <div class="card-body">
        <div class="row">
            {{-- <button class="btn btn-success mb-2"><i class="bi bi-journal-plus mr-2"></i> Form</button> --}}
            <div class="col-md-12">
                <form class="formasumarilisnya">
                    <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="inputEmail4">Tgl sumarilis / kunjungan</label>
                        <input type="date" class="form-control" id="tanggalsumarilis" name="tanggalsumarilis">
                        <input hidden type="text" class="form-control" id="nomorrm" name="nomorrm" value="{{ $nomorrm }}">
                        <input hidden type="text" class="form-control" id="kodekunjungan" name="kodekunjungan" value="{{ $kodekunjungan }}">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputPassword4">Diagnosa</label>
                        <input type="test" class="form-control" id="diagnosasum" name="diagnosasum">
                      </div>
                      <div class="form-group col-md-1">
                        <label for="inputPassword4">Siklus</label>
                        <input type="text" class="form-control" id="siklus" name="siklus">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="inputPassword4">keterangan Regimen</label>
                        <textarea type="text" class="form-control" id="ketreg" name="ketreg"></textarea>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="inputPassword4">Obat</label>
                        <textarea type="text" class="form-control" id="obat" name="obat"></textarea>
                      </div>
                    </div>
                    <button type="button" class="btn btn-success mt-3 mb-3" onclick="simpansumarilis()">Simpan</button>
                  </form>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">Riwayat</div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <th>Tanggal Regimen</th>
                                <th>Diagnosa</th>
                                <th>Siklus</th>
                                <th>Keterangan Regimen</th>
                                <th>Obat Obatan</th>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $r )
                                    <tr>
                                        <td>{{ $r->tgl_kunjungan}}</td>
                                        <td>{{ $r->diagnosa}}</td>
                                        <td>{{ $r->siklus}}</td>
                                        <td>{{ $r->ket_regimen}}</td>
                                        <td>{{ $r->obat}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function simpansumarilis()
    {
        var data = $('.formasumarilisnya').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpansumarilis') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
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
                    formsumarilis()
                }
            }
        });
    }
</script>
