<input hidden type="text" class="form-control" id="kode_kunjungan" aria-describedby="emailHelp"
    value="{{ $kodekunjungan }}">
@if(count($cek_konsul) > 0)
<label for="">Data Poliklinik konsul</label>
<table class="table table-sm table-bordered table-hover">
    <thead>
        <th>Nama Poli</th>
        <th>Diagnosa</th>
        <th>Keterangan</th>
        <th>---</th>
    </thead>
    <tbody>
        @foreach ($cek_konsul as $c )
            <tr>
                <td>{{ $c->nama_unit}}</td>
                <td>{{ $c->diagx}}</td>
                <td>{{ $c->keterangan3}}</td>
                <td><button class="badge badge-danger batalkonsul" kode="{{ $c->kode_kunjungan }}"><i class="bi bi-trash"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<div class="card">
    <div class="card-header bg-warning">Tindak Lanjut</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if(count($cek_iter) > 0)
            <h5 class="text-danger">*Pasien termasuk kedalam layanan Iterasi obat BPJS ( layanan peresepan obat kronis yang memungkinkan peserta JKN (Jaminan Kesehatan Nasional) untuk mendapatkan obat-obatan tanpa harus berkonsultasi dengan dokter setiap bulan.  )</h5> <br>
            <table class="table table-sm mb-4">
                <thead>
                    <th>Tanggal iterasi</th>
                    <th>Dokter</th>
                    <th>Unit</th>
                    <th>Jumlah iterasi obat</th>
                </thead>
                <tbody>
                    @foreach ($cek_iter as $c )
                        <tr>
                            <td>{{ $c->tgl_iter}}</td>
                            <td>{{ $c->nama_dokter}}</td>
                            <td>{{ $c->nama_unit}}</td>
                            <td>{{ $c->jumlah}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <div class="jumbotron">
            {{-- <h1 class="display-4">Tindak Lanjut</h1> --}}
            @if ($selisih > 70)
            <div class="alert alert-warning" role="alert">
                @if (count($kunjunganKronis) > 0)
                    Pasien Kronis ,
                @endif Pasien Berpotensi PRB, dan melanjutkan pengobatan kembali ke faskes 1...
              </div>
            @endif
            <p class="lead mt-4"><strong>* @foreach ($assdok as $as)
                {{ $as->tindak_lanjut }}
            @endforeach</strong></p>
            <hr class="my-4">
            <p>diisi oleh :  @foreach ($assdok as $as)
                {{ $as->nama_dokter }} @endforeach |  @foreach ($assdok as $as)
                {{ $as->tgl_pemeriksaan }} @endforeach</p>
            {{-- <a class="btn btn-primary btn-lg btntindaklanjut" jenis="surkon" role="button"><i
                    class="bi bi-plus-lg mr-1"></i> Surat Kontrol</a> --}}
            <a class="btnbuatsurat btn btn-success"> Buat surat pengantar Konsul / Rujin ...</a><br><br>
            <a class="btn btn-primary btn-lg btntindaklanjut" jenis="konsul" role="button"><i
                    class="bi bi-plus-lg mr-1"></i>Daftar</a>
            <h5 id="emailHelp" class="form-text text-danger font-italic">Klik daftar jika pasien dikonsulkan / dirujuk ke poli lain dihari yang sama ...( Jika pasien dirujuk atau dikonsulkan ke poli lain dihari yang berbeda cukup buat surat pengantarnya ... )<br><br></h5>
            <a class="btnbuatsurat btn btn-success" onclick="goto_suratkontrol()"> Buat Surat Kontrol ...</a><br><br>
            <div class="v_t_surat mt-2 mb-2">
                
            </div>
            
            {{-- <a class="btn btn-primary btn-lg btntindaklanjut" jenis="rujukkeluar" role="button"><i
                    class="bi bi-plus-lg mr-1"></i> Rujuk Keluar</a> --}}
        </div>
        <div class="col-md-12">
            <div class="formtindaklanjutnya">

            </div>
        </div>
    </div>
</div>
<script>
    $(".btnbuatsurat").on('click', function(event) {
        kodekunjungan = $('#kodekunjungan').val()
        Swal.fire("Silahkan isi form dibawah ... !");
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
            },
            url: '<?= route('formpembuatansuratpengantar') ?>',
            success: function(response) {
                $('.formtindaklanjutnya').html(response);
                spinner.hide()
            }
        });
    });
    $(".btntindaklanjut").on('click', function(event) {
        kodekunjungan = $('#kodekunjungan').val()
        jenis = $(this).attr('jenis')
        Swal.fire("Silahkan isi form dibawah ... !");
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
    $(".batalkonsul").on('click',function(event){
        kode = $(this).attr('kode')
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kode
            },
            url: '<?= route('batalkonsul') ?>',
            error: function(data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
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
                    formtindaklanjut()
                }
            }
        });
    })
     $(document).ready(function() {
        ambilriwayatsurat()
     })
    function ambilriwayatsurat()
    {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kode_kunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambilriwayatsurat') ?>',
            error:function(data){
                 Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
                spinner.hide()
            },
            success: function(response) {
                $('.v_t_surat').html(response);
                spinner.hide()
            }
        });
    }
</script>
