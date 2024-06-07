<div class="accordion" id="accordionExample_penunjang1">
    <div class="card">
        <div class="card-header bg-light" id="headingFour_penunjang">
            <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left text-dark text-bold collapsed" type="button"
                    data-toggle="collapse" data-target="#collapseFour_penunjang1" aria-expanded="false"
                    aria-controls="collapseFour_penunjang1">
                    <i class="bi bi-plus-lg"></i> Order Radiologi
                </button>
            </h2>
        </div>
        <div id="collapseFour_penunjang1" class="collapse" aria-labelledby="headingFour_penunjang"
            data-parent="#accordionExample_penunjang1">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">Riwayat order radiologi hari ini ...</div>
                    <div class="card-body">
                        <div class="v_r_order_rad_hari_ini">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">Silahkan pilih layanan Radiologi</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm table-bordered table-hover"
                                        id="tabel_pilih_layanan_rad">
                                        <thead>
                                            <th>Nama Layanan</th>
                                            <th>Tarif</th>
                                        </thead>
                                        @foreach ($layanan_rad as $l)
                                            <tr class="pilihlayanan_rad" id="{{ $l->kode }}"
                                                nama="{{ $l->Tindakan }}" tarif={{ $l->tarif }}>
                                                <td>{{ $l->Tindakan }}</td>
                                                <td>{{ $l->tarif }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-secondary"><i class="bi bi-check-lg mr-2"></i>
                                            List
                                            Layanan Radiologi yang dipilih</div>
                                        <div class="card-body">
                                            <form action="" method="post" class="form_order_rad">
                                                <div class="field_rad" id="field_fix_rad">
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
            riwayat_order_rad()
        })
        $(function() {
            $("#tabel_pilih_layanan_rad").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 5,
                "searching": true
            })
        });
        $(".pilihlayanan_rad").on('click', function(event) {
            var max_fields = 10; //maximum input boxes allowed
            var wrapper = $(".field_rad"); //Fields wrapper
            var x = 1; //initlal text box count
            // e.preventDefault();
            namatindakan = $(this).attr('nama')
            tarif = $(this).attr('tarif')
            id = $(this).attr('id')
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                    '<div class="form-row text-xs"><div class="form-group col-md-6"><label for="">Nama Tindakan</label><input readonly type="" class="form-control form-control-sm" id="" name="namatindakan" value="' +
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

        function riwayat_order_rad() {
            kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan
                },
                url: '<?= route('ambil_riwayat_order_rad') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('error')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_r_order_rad_hari_ini').html(response);
                }
            });
        }
    </script>
