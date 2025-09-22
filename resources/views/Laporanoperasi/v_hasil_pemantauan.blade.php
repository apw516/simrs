<div class="card mt-3">
    <div class="card-header">Pemantauan Anestesi Lokal</div>
    <div class="card-body">
        @foreach ($header as $h)
            <button class="btn btn-warning mb-3 pilihheader" idheader="{{ $h->id }}" data-toggle="modal"
                data-target="#modalhasil">+ Hasil</button>
            <table class="table table-sm table-bordered">
                <tr>
                    <td colspan="3" class="text-center text-bold font-lg">PEMANTAUAN ANESTESI LOKAL</td>
                </tr>
                <tr>
                    <td>Diagnosa : {{ $h->diagnosa }}</td>
                    <td>Tindakan :  {{ $h->tindakan }}</td>
                    <td>Bagian :  {{ $h->bagian }}</td>
                </tr>
                <tr>
                    <td>Jam mulai operasi : {{ $h->jam_mulai_operasi }}</td>
                    <td colspan="2">Tanggal operasi : {{ $h->tanggal_operasi }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama Obat yang diberikan</th>
                                <th rowspan="2">Dosis 1</th>
                                <th rowspan="2">Dosis 2</th>
                                <th rowspan="2">Dosis 3</th>
                                <th rowspan="2">Vitalsign RR</th>
                                <th rowspan="2">Vitalsign HR</th>
                                <th rowspan="2">Vitalsign TD</th>
                                <th colspan="10">Time</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>5'</th>
                                <th>10'</th>
                                <th>15'</th>
                                <th>20'</th>
                                <th>25'</th>
                                <th>30'</th>
                                <th>35'</th>
                                <th>40'</th>
                                <th>45'</th>
                                <th>50'</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail as $d)
                                @if($d->id_header == $h->id)
                                    <tr>
                                        <td></td>
                                        <td>{{ $d->nama_obat_yang_diberikan}}</td>
                                        <td>{{ $d->dosis_1}}</td>
                                        <td>{{ $d->dosis_2}}</td>
                                        <td>{{ $d->dosis_3}}</td>
                                        <td>{{ $d->vitalsign_RR}}</td>
                                        <td>{{ $d->vitalsign_HR}}</td>
                                        <td>{{ $d->vitalsign_TD_S_D}}</td>
                                        <td>{{ $d->time_5}}</td>
                                        <td>{{ $d->time_10}}</td>
                                        <td>{{ $d->time_15}}</td>
                                        <td>{{ $d->time_20}}</td>
                                        <td>{{ $d->time_25}}</td>
                                        <td>{{ $d->time_30}}</td>
                                        <td>{{ $d->time_35}}</td>
                                        <td>{{ $d->time_40}}</td>
                                        <td>{{ $d->time_45}}</td>
                                        <td>{{ $d->time_50}}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger">hapus</button>
                                            <button class="btn btn-sm btn-warning">edit</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">Saturasi : {{ $h->saturasi }}</td>
                </tr>
                <tr>
                    <td colspan="3">Kesadaran : {{ $h->kesadaran }}</td>
                </tr>
                <tr>
                    <td colspan="3">Jam Selesai Operasi  : {{ $h->jam_selesai_oprasi }}</td>
                </tr>
            </table>
        @endforeach
    </div>
</div>
<div class="modal fade" id="modalhasil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input hasil pemantauan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_form_hasil">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanhasilpantauan()">SIMPAN</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(".pilihheader").on('click', function(event) {
        idheader = $(this).attr('idheader')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idheader
            },
            url: '<?= route('ambil_form_hasil_pemantauan') ?>',
            success: function(response) {
                $('.v_form_hasil').html(response);
                spinner.hide()
            }
        });
    });
    function simpanhasilpantauan() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.form_hasil_pantauan').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data)
            },
            url: '<?= route('simpanhasil_pantauan') ?>',
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
                    $('#modalhasil').modal('toggle')
                    ambil_hasil_pemantauan()
                }
            }
        });
    }
</script>
