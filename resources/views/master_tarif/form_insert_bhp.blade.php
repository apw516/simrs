<h5>NAMA TINDAKAN : {{ $dataheader[0]->NAMA_TARIF }}</h5>
<div class="card mt-4">
    <div class="card-header">Cari BHP</div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Masukan nama barang</label>
                    <input type="text" name="namabarang" id="namabarang" class="form-control"
                        id="exampleFormControlInput1" placeholder="Ketik nama tarif ....">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button class="btn btn-success" style="margin-top:32px" onclick="caribarang()"><i
                            class="bi bi-search mr-2 ml-2"></i> Cari barang</button>
                </div>
            </div>
        </div>
        <div class="v_tabel_barang mt-4">

        </div>
        <div class="card">
            <div class="card-header">List BHP terpilih ...</div>
            <div class="card-body">
                <form action="" method="post" class="formbphterpilih">
                    <div class="draft_bhp">
                        <div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-success float-right" onclick="simpanbhp()">Simpan BHP</button>
            </div>
        </div>
    </div>
</div>
<script>
    function caribarang() {
        namabarang = $('#namabarang').val()
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                namabarang
            },
            url: '<?= route('caribarangbhp') ?>',
            success: function(response) {
                spinner.hide();
                $('.v_tabel_barang').html(response);
            }
        });
    }

    function simpanbhp() {
        var data = $('.formbphterpilih').serializeArray();
        kodetarifheader = $('#kodetarifheader').val()
        namatarif = $('#namatarifterpilih').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
                kodetarifheader,namatarif
            },
            url: '<?= route('simpandatabhp') ?>',
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
                spinnerof()
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
                }
            }
        });
    }
</script>
