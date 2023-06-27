<div class="card">
    <div class="card-header bg-warning">Tindak Lanjut</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        <div class="jumbotron">
            {{-- <h1 class="display-4">Tindak Lanjut</h1> --}}
            <p class="lead mt-4"><strong>* {{ $assdok[0]->tindak_lanjut }}</strong></p>
            <hr class="my-4">
            <p>diisi oleh : {{ $assdok[0]->nama_dokter }} | {{ $assdok[0]->tgl_pemeriksaan }}</p>
            <a class="btn btn-primary btn-lg btntindaklanjut" jenis="surkon" role="button"><i
                    class="bi bi-plus-lg mr-1"></i> Surat Kontrol</a>
            <a class="btn btn-primary btn-lg btntindaklanjut" jenis="konsul" role="button"><i
                    class="bi bi-plus-lg mr-1"></i> Konsul Poli Lain</a>
            <a class="btn btn-primary btn-lg btntindaklanjut" jenis="rujukkeluar" role="button"><i
                    class="bi bi-plus-lg mr-1"></i> Rujuk Keluar</a>
        </div>
        <div class="col-md-12">
            <div class="formtindaklanjutnya">

            </div>
        </div>
    </div>
</div>

<script>
    $(".btntindaklanjut").on('click', function(event) {
        kodekunjungan = $('#kodekunjungan').val()
        jenis = $(this).attr('jenis')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                jenis
            },
            url: '<?= route('formsurkon') ?>',
            success: function(response) {
                $('.formtindaklanjutnya').html(response);
                spinner.hide()
            }
        });
    });
</script>
