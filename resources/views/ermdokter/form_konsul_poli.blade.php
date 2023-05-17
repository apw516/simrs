<form class="mt-3">
    <div class="form-group">
        <label for="exampleInputEmail1">Poli Tujuan</label>
        <div class="form-group">
            <select class="form-control" id="politujuan" name="politujuan">
                @foreach ($unit as $u)
                    <option value="{{ $u->kode_unit }}"> {{ $u->nama_unit }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <button type="button" class="btn btn-primary" onclick="simpankonsul()">Konsul</button>
</form>
<script>
    function simpankonsul() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $('#kodekunjungan').val()
        politujuan = $('#politujuan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                politujuan
            },
            url: '<?= route('simpankonsul_poli') ?>',
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
                }
            }
        });
    }
</script>
