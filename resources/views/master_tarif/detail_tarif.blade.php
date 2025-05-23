<button class="btn btn-danger mb-4" onclick="kembali()">Kembali</button>
<input hidden type="text" value="{{ $dataheader[0]->KODE_TARIF_HEADER}}" id="kodetarifheader">
<input hidden type="text" value="{{ $dataheader[0]->NAMA_TARIF}}" id="namatarifterpilih">
<div class="card">
    <div class="card-header">Detail Tarif</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h5>{{ strtoupper($dataheader[0]->NAMA_TARIF) }}</h5>
                <div class="btn-group mt-5" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" data-toggle="modal"
                        data-target="#modalinsertbhp" onclick="addforminsertbhp()">Insert BHP</button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Tarif</div>
                    <div class="card-body">
                        <table class="table table-sm table-bordered text-xs">
                            <thead>
                                <th>KELAS TARIF</th>
                                <th>TARIF RAJAL</th>
                                <th>TARIF RANAP</th>
                                <th>TARIF IGD</th>
                                <th>TARIF ICU</th>
                                <th>TARIF OPERASI 1</th>
                                <th>TARIF OPERASI 2</th>
                                <th>TARIF PENUNJANG</th>
                                <th>TARIF CITO</th>
                                <th>SPESIALIS</th>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($datadetail as $d)
                                        <td>{{ $d->KELAS_TARIF }}</td>
                                        <td>RP . {{ number_format($d->tarif_rajal, 2) }} </td>
                                        <td>RP. {{ number_format($d->tarif_ranap, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_igd, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_intensif, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_operasi1, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_operasi2, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_penunjang, 2) }}</td>
                                        <td>RP. {{ number_format($d->tarif_cito, 2) }}</td>
                                        <td>RP. {{ number_format($d->spesialis, 2) }}</td>
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

<!-- Modal -->
<div class="modal fade" id="modalinsertbhp" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Insert BHP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_insert_bhp">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    function kembali() {
        $('.v_12').removeAttr('Hidden', true)
        $('.v_22').attr('Hidden', true)
    }

    function addforminsertbhp() {
        spinner = $('#loader')
        spinner.show();
        kodetarifheader = $('#kodetarifheader').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",kodetarifheader
            },
            url: '<?= route('ambilforminsertbhp') ?>',
            success: function(response) {
                spinner.hide();
                $('.v_form_insert_bhp').html(response);
            }
        });
    }
</script>
