<form action="" class="formeditorderpenunjang">
    <div class="form-group">
        <label for="exampleInputEmail1">Tanggal periksa Penunjang</label>
        <input type="date" class="form-control" id="tglperiksa" aria-describedby="emailHelp" value="{{ $cek_header[0]->tgl_periksa}}" name="tglperiksa">
        <input hidden type="text" class="form-control" id="iddetail" aria-describedby="emailHelp" value="{{ $cek_detail[0]->id}}" name="iddetail">
        <input hidden type="text" class="form-control" id="idheader" aria-describedby="emailHelp" value="{{ $cek_detail[0]->row_id_header}}" name="idheader">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Jumlah Layanan</label>
        <input type="text" class="form-control" id="jmlh" name="jmlh" value="{{ $cek_detail[0]->jumlah_layanan }}">
    </div>
</form>
<script>
    function simpaneditorder() {
        var data = $('.formeditorderpenunjang').serializeArray();
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
                spinneron()
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpaneditorderpenunjang') ?>',
                    error: function(data) {
                        spinnerof()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        if (data.kode == 500) {
                            spinnerof()
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            $('#modaleditorderpenunjnag').modal('toggle');
                            $('#modalriwayatorderpenunjanghariini').modal('toggle');
                            spinnerof()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })

                        }
                    }
                });
            }
        });
    }
</script>
