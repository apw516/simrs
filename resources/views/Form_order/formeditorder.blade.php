<form action="" class="formeditorderfarmasi">
    <div class="form-group">
        <label for="exampleInputEmail1">Nama Obat</label>
        <input type="text" class="form-control" id="namaobat" aria-describedby="emailHelp" value="{{ $cek_detail[0]->nama_barang}}" name="namaobat">
        <input hidden type="text" class="form-control" id="iddetail" aria-describedby="emailHelp" value="{{ $cek_detail[0]->id}}" name="iddetail">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Aturan Pakai</label>
        <textarea type="text" class="form-control" id="aturanpakai" name="aturanpakai">{{ $cek_detail[0]->aturan_pakai}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Jumlah</label>
        <input type="text" class="form-control" id="jmlh" name="jmlh" value="{{ $cek_detail[0]->qty }}">
    </div>
</form>
<script>
    function simpaneditorder() {
        var data = $('.formeditorderfarmasi').serializeArray();
        Swal.fire({
            title: "Apakah data Order sudah benar ?",
            text: "Klik OK untuk simpan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpaneditorder') ?>',
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
                        if (data.kode == 500) {
                            spinner.hide()
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            spinner.hide()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                            $('#modaleditorder').modal('toggle');
                            $('#modalriwayatorderhariini').modal('toggle');
                        }
                    }
                });
            }
        });
    }
</script>
