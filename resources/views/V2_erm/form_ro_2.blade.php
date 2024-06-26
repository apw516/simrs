<div class="card">
    <div class="card-header">Form Hasil Pemeriksaan RO</div>
    <div class="card-header">
        <form action="" class="formro">
            <input hidden type="text" name="kodekunjungan" id="kodekunjungan" value="{{ $kodekunjungan }}">
            <input  hidden type="text" name="rm" id="rm" value="{{ $rm }}">
        <textarea  class="form-control" name="hasilpemeriksaan" id="hasilpemeriksaan" cols="30" rows="20">@foreach ($ro_lama as $r ){{ trim($r->tajampenglihatandekat)}}
        Tekanan Intraokular : {{ $r->tekananintraokular}}
        Palpebra : {{ $r->palpebra}}
        Konjungtiva : {{ $r->konjungtiva}}
        Kornea : {{ $r->kornea}}
        Bilik mata depan : {{ $r->bilikmatadepan}}
        pupil : {{ $r->pupil}}
        iris : {{ $r->iris}}
        lensa : {{ $r->lensa}}
        funduskopi : {{ $r->funduskopi}}
        status oftamologis khusus : {{ $r->status_oftamologis_khusus}}
        masalah medis : {{ $r->masalahmedis}}
        prognosis : {{ $r->prognosis}}
        catatan pemeriksaan lain : {{ $r->catatanpemeriksaanlain}}
        @endforeach</textarea>
        </form>
    </div>
    <div class="card-footer">
        <button class="btn btn-success" onclick="simpanhasil()">Simpan</button>
    </div>
</div>
<script>
    function simpanhasil() {
        var formro = $('.formro').serializeArray();
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                formro: JSON.stringify(formro)
            },
            url: '<?= route('v2_simpanpemeriksaan_ro_2') ?>',
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
                    ambildatapasien()
                }
            }
        });
    }
</script>
