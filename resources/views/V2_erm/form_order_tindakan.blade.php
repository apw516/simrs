<div class="accordion" id="accordionExample_penunjang1">
    <div class="card">
        <div class="card-header bg-light" id="headingOne_Penunjang">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-dark text-bold text-left collapsed" type="button"
                    data-toggle="collapse" data-target="#collapseOne_penunjang1" aria-expanded="true"
                    aria-controls="collapseOne_penunjang1">
                    <i class="bi bi-plus-lg"></i> Billing Tindakan Poliklinik
                </button>
            </h2>
        </div>
        <div id="collapseOne_penunjang1" class="collapse" aria-labelledby="headingOne_Penunjang"
            data-parent="#accordionExample_penunjang1">
            <div class="card-body">
                <div class="card">
                    <div class="card-header bg-light font-italic">Riwayat Tindakan hari ini
                        ...</div>
                    <div class="card-body">
                        <div class="v_riwayat_tindakan_tdy">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light font-italic">Silahkan Pilih Tindakan
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm table-bordered table-hover" id="tabel_pilih_layanan">
                                    <thead>
                                        <th>Nama Tindakan</th>
                                        <th>Tarif</th>
                                    </thead>
                                    @foreach ($layanan as $l)
                                        <tr class="pilihtindakan" id="{{ $l->kode }}" nama="{{ $l->Tindakan }}"
                                            tarif={{ $l->tarif }}>
                                            <td>{{ $l->Tindakan }}</td>
                                            <td>{{ $l->tarif }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header bg-secondary"><i class="bi bi-check-lg mr-2"></i> List
                                        tindakan yang dipilih</div>
                                    <div class="card-body">
                                        <form action="" method="post" class="formbillingtindakan">
                                            <div class="field_tindakan" id="field_fix_tindakan">
                                                <div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        riwayat_tindakan()
    })
    $(function() {
        $("#tabel_pilih_layanan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true
        })
    });
    $(".pilihtindakan").on('click', function(event) {
        var max_fields = 10; //maximum input boxes allowed
        var wrapper = $(".field_tindakan"); //Fields wrapper
        var x = 1; //initlal text box count
        // e.preventDefault();
        namatindakan = $(this).attr('nama')
        tarif = $(this).attr('tarif')
        id = $(this).attr('id')
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append(
                '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
                namatindakan +
                '"><input hidden readonly type="" class="form-control form-control-sm" id="" name="kodetindakan" value="' +
                id +
                '"></div><div class="form-group col-md-2"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
                tarif +
                '"></div><div class="form-group col-md-1"><label for="inputPassword4">Jumlah</label><input readonly type="" class="form-control form-control-sm" id="" name="jumlah" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-2 text-danger" kode2=""></i></div>'
            );
            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        }
    });

    function riwayat_tindakan() {
        kodekunjungan = $('#kodekunjungan').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambil_riwayat_tindakan_Tdy') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                spinner.hide()
                $('.v_riwayat_tindakan_tdy').html(response);
            }
        });
    }
</script>
