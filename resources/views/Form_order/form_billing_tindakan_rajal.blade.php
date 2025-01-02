<div class="card">
    <div class="card-header">Billing Tindakan Poliklinik</div>
    <div class="card-body">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-info riwayattindakanhariini" data-toggle="modal"
                data-target="#modalriwayattindakanhariini"><i class="bi bi-plus"></i>Riwayat Billing Tindakan Hari
                ini</button>
        </div><br><br>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Silahkan Pilih Tindakan / Tarif Rawat Jalan</div>
                    <div class="card-body">
                        <table id="tabeltindakanpoli" class="table table-sm table-bordered table-hover text-xs">
                            <thead>
                                <th>Nama Tarif / Tindakan</th>
                                <th>Tarif</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($layanan as $l)
                                    <tr>
                                        <td>{{ $l->Tindakan }}</td>
                                        <td>Rp. {{ number_format($l->tarif, 2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success btn-sm text-xs pilihtindakan"
                                            nama = "{{ $l->Tindakan}}"
                                            idtarif = {{ $l->kode}}
                                            tarif = {{ $l->tarif}}
                                            dtarif = "Rp. {{ number_format($l->tarif, 2) }}"
                                            ><i class="bi bi-plus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">List Tindakan / Tarif Rawat Jalan</div>
                    <div class="card-body">
                        <form action="" method="post" class="form_draft_billing_tindakan">
                            <div class="draft_tindakan">
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
<div class="modal fade" id="modalriwayattindakanhariini" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Riwayat Tindakan Hari ini ...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_r_order_tindakan_tdy">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabeltindakanpoli").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".riwayattindakanhariini").on('click', function(event) {
        kode_kunjungan = $('#kode_kunjungan').val()
        rm = $('#no_rm').val()
        spinneron()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan,rm
            },
            url: '<?= route('ambil_riwayat_tindakan_yang_sudah_diinput') ?>',
            error: function(response) {
                spinnerof()
            },
            success: function(response) {
                spinnerof()
                $('.v_r_order_tindakan_tdy').html(response);
            }
        });
    })
    $(".pilihtindakan").on('click', function(event) {
        nama = $(this).attr('nama')
        kodetarif = $(this).attr('idtarif')
        tarif = $(this).attr('tarif')
        dtarif = $(this).attr('dtarif')
        var wrapper = $(".draft_tindakan");
        $(wrapper).append(
            '<div class="form-row text-xs"><div class="form-group col-md-4"><label for="">Nama Tindakan/Tarif</label><input readonly type="" class="form-control form-control-sm text-xs edit_field" id="" name="namatarif" value="' +
            nama +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="kodetarif" value="' +
            kodetarif +
            '"><input  hidden readonly type="" class="form-control form-control-sm" id="" name="tarif" value="' +
            tarif +
            '"></div><div class="form-group col-md-3"><label for="inputPassword4">Tarif</label><input readonly type="" class="form-control form-control-sm" id="" name="displaytarif" value="' +
            dtarif +
            '"></div><div class="form-group col-md-2"><label for="inputPassword4">Qty</label><input type="" class="form-control form-control-sm" id="" name="qty" value="1"></div><i class="bi bi-x-square remove_field form-group col-md-1 text-danger" kode2=""></i></div>'
        );
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
