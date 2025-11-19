@if(count($cekjawaban) > 0)
    <div class="card">
        <div class="card-header bg-warning">Catatan Konsul / Rujuk Internal</div>
        <div class="card-body">
            Terima kasih sudah menjawab   {{ $cekjawaban[0]->jenis_surat }} ... <br>
            dari : {{ $cekjawaban[0]->namadokterkirim}} <br>
            Jawaban : {{ $cekjawaban[0]->jawaban}} <br>
            <button class="btn btn-warning mb-2 mt-2 editjawaban"><i class="bi bi-pencil-square"></i> Edit</button>
            <div hidden class="v_jawab" >
                <div class="card">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Jawaban Konsul</label>
                            <textarea class="form-control" id="jawabankonsul2" rows="3">{{ $cekjawaban[0]->jawaban}}</textarea>
                            <input hidden type="text" id="idkonsul2" value="{{ $cekjawaban[0]->id}}">
                            <input hidden type="text" id="kode_kunjungan_jwb2" value="{{ $cekjawaban[0]->kode_kunjungan_jawab}}">
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success" onclick="simpanjawaban2()">Simpan Jawaban</button>
                            <button class="btn btn-danger" onclick="batal()">Batal</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(count($cek_konsul)>0)
<div class="card">
    <div class="card-header bg-warning">Catatan Konsul / Rujuk Internal</div>
    <div class="card-body">
        <div class="alert alert-light" role="alert">
            {{ $cek_konsul[0]->jenis_surat }} belum dijawab ... <br>
            Pengirim : {{ $cek_konsul[0]->namadokterkirim}} <br>
            Unit {{ $cek_konsul[0]->unitasal}} <br>
            @if($cek_konsul[0]->jenis_surat == 'SURAT KONSUL')
            Keterangan : {{ $cek_konsul[0]->keterangan }}
            @else
            Keterangan Klinik / Diagnosa : {{ $cek_konsul[0]->keterangan_klinis }} <br>
            Keterangan Lain : {{ $cek_konsul[0]->keterangan}}
            @endif
            <br>
            Tanggal Konsul : {{ \Carbon\Carbon::parse($cek_konsul[0]->tanggal_entry )->format('d-M-Y') }}
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-success" data-toggle="modal" data-target="#modaljawabkonsul"><i class="bi bi-question-lg"></i> Jawab</button>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaljawabkonsul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Jawaban Konsul</label>
                    <textarea class="form-control" id="jawabankonsul" rows="3"></textarea>
                    <input hidden type="text" id="idkonsul" value="{{ $cek_konsul[0]->id}}">
                    <input hidden type="text" id="kode_kunjungan_jwb" value="{{ $kunjungan[0]->kode_kunjungan}}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanjawabankonsul()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endif
<script>
    function simpanjawabankonsul() {
        jawabankonsul = $('#jawabankonsul').val()
        idkonsul = $('#idkonsul').val()
        kode_kunjungan_jwb = $('#kode_kunjungan_jwb').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , jawabankonsul
                , idkonsul
                , kode_kunjungan_jwb
            }
            , url: '<?= route('simpanjawabankonsul') ?>'
            , error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error'
                    , title: 'Ooops....'
                    , text: 'Sepertinya ada masalah......'
                    , footer: ''
                })
            }
            , success: function(data) {
                spinner.hide()
                $('#modaljawabkonsul').modal('hide')
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oopss...'
                        , text: data.message
                        , footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success'
                        , title: 'OK'
                        , text: data.message
                        , footer: ''
                    })
                    catatankonsul()
                }
            }
        });
    }
    function simpanjawaban2() {
        jawabankonsul = $('#jawabankonsul2').val()
        idkonsul = $('#idkonsul2').val()
        kode_kunjungan_jwb = $('#kode_kunjungan_jwb2').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true
            , type: 'post'
            , dataType: 'json'
            , data: {
                _token: "{{ csrf_token() }}"
                , jawabankonsul
                , idkonsul
                , kode_kunjungan_jwb
            }
            , url: '<?= route('simpanjawabankonsul') ?>'
            , error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error'
                    , title: 'Ooops....'
                    , text: 'Sepertinya ada masalah......'
                    , footer: ''
                })
            }
            , success: function(data) {
                spinner.hide()
                $('#modaljawabkonsul').modal('hide')
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Oopss...'
                        , text: data.message
                        , footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success'
                        , title: 'OK'
                        , text: data.message
                        , footer: ''
                    })
                    catatankonsul()
                }
            }
        });
    }
    $(".editjawaban").click(function() {       
        $('.v_jawab').removeAttr('hidden',true)
    })
    function batal()
    {
        $('.v_jawab').attr('hidden',true)
    }
</script>