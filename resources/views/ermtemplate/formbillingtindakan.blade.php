<input hidden type="text" class="form-control" id="kode_kunjungan" aria-describedby="emailHelp"
    value="{{ $data_kunjungan[0]->kode_kunjungan }}">
<div class="card">
    <div class="card-header bg-info">
        Input Billing Tindakan
    </div>
    <div class="card-body">
        <button type="button" class="btn btn-warning mb-2 lihatriwayattindakan" data-toggle="modal" data-target="#modalriwayattindakan"><i
            class="bi bi-eye mr-1"></i> Lihat Riwayat</button>
        <div class="form-group">
            <label for="exampleInputEmail1">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tglmasuk" aria-describedby="emailHelp"
                value="{{ $data_kunjungan[0]->tgl_masuk2 }}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Dokter Pemeriksa</label>
            <input type="text" class="form-control" id="namadokter" aria-describedby="emailHelp"
                value="{{ $data_kunjungan[0]->nama_dokter }}">
            <input hidden type="text" class="form-control" id="kodeparamedis" aria-describedby="emailHelp"
                value="{{ $data_kunjungan[0]->kode_paramedis }}">
        </div>
        <div class="card">
            <div class="card-header">Pilih Nama Tarif</div>
            <div class="card-body">
                <table id="tabeltindakan" class="table table-sm table-bordered table-hover">
                    <thead class="bg-secondary">
                        <th>Kode Tindakan</th>
                        <th>Nama Tindakan</th>
                        <th>Tarif</th>
                        <th>===</th>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $l)
                            <tr>
                                <td>{{ $l->kode }}</td>
                                <td>{{ $l->Tindakan }}</td>
                                <td>{{ $l->tarif }}</td>
                                <td><button class="btn btn-success pilihlayanan" kode = "{{ $l->kode }}"
                                        namatindakan = "{{ $l->Tindakan }}" tarif = "{{ $l->tarif }}"
                                        id="{{ $l->kode }}">Pilih layanan</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card">
                    <div class="card-header">Tindakan yang dipilih</div>
                    <div class="card-body">
                        <form action="" method="post" class="formtindakan">
                            <div class="input_fields_wrap">
                                <div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-warning mb-2 simpanlayanan" id="simpanlayanan"><i
                                class="bi bi-box-arrow-down"></i> Simpan
                            Tindakan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalriwayattindakan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Riwayat Tindakan yang sudah diinput</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="v_riwayat_tindakan">

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
    $(document).ready(function() {
        $('#namadokter').autocomplete({
            source: "<?= route('caridokter') ?>",
            select: function(event, ui) {
                $('[id="namadokter"]').val(ui.item.label);
                $('[id="kodeparamedis"]').val(ui.item.kode);
            }
        });
    })
    $(function() {
        $("#tabeltindakan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 5,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        })
    })
    $('#tabeltindakan').on('click', '.pilihlayanan', function() {
        if ($(this).attr('status') == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Layanan sudah dipilih !',
                text: 'Silahkan isi jumlah layanan jika layanan lebih dari 1 ...',
                footer: ''
            })
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Layanan dipilih !',
                showConfirmButton: false,
                timer: 1500
            })
            $(this).attr("status", "1");
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var x = 1; //initlal text box count
            kode = $(this).attr('kode')
            namatindakan = $(this).attr('namatindakan')
            tarif = $(this).attr('tarif')
            // e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-5"><label for="">Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                        namatindakan +
                        '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodelayanan" value="' +
                        kode +
                        '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                        tarif +
                        '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><div class="form-group col-md-1"><label for="inputPassword4">Disc</label><input type="" class="form-control form-control-sm" id="" name="disc" value="0"></div><div class="form-group col-md-1"><label for="inputPassword4">Cyto</label><input type="" class="form-control form-control-sm" id="" name="cyto" value="0"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2="' +
                        kode + '"></i></div>'
                );
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    kode = $(this).attr('kode2')
                    $('#' + kode).removeAttr('status', true)
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        }
    });
    $(".simpanlayanan").click(function() {
        var data = $('.formtindakan').serializeArray();
        var kodekunjungan = $('#kode_kunjungan').val()
        tglmasuk = $('#tglmasuk').val()
        kodeparamedis = $('#kodeparamedis').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodekunjungan: kodekunjungan,
                tglmasuk,
                kodeparamedis,
            },
            url: '<?= route('simpanbilling') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Sepertinya ada masalah ...',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: 'Data berhasil disimpan!',
                        footer: ''
                    })
                    formbillingtindakan()
                }
            }
        });
    });
    $(".lihatriwayattindakan").click(function(){
        var kodekunjungan = $('#kode_kunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('riwayattindakanpoli') ?>',
            success: function(response) {
                $('.v_riwayat_tindakan').html(response);
                spinner.hide()
            }
        });
    })
