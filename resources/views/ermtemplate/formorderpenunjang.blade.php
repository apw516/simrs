<div class="card">
    <div class="card-header bg-warning">Order Penunjang</div>
    <div class="card-body table-responsive p-5" style="height: 757Px">
        @if (count($assdok) > 0)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Diagnosa Pemeriksaan Penunjang</label>
                        <input type="text" id="diagnosapemeriksaanpenunjang" class="form-control"
                            value="{{ $assdok[0]->diagnosakerja }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Tanggal Pemeriksaan Penunjang</label>
                        <input type="date" id="tanggalperiksapenunjang" value="03/06/2023" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pilih Unit Penunjang</label>
                        <select class="form-control" id="pilihpenunjang" onchange="pilihform()">
                            <option id="selected2" value="0">Silahkan Pilih</option>
                            <option value="1">Radiologi</option>
                            <option value="2">Laboratorium</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="formnya">

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">Riwayat Order</div>
                        <div class="card-body">
                            <div class="riwayatorder">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi
                    ...</h3>
                <p>
                    Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                </p>
            </div>
        @endif
    </div>
</div>
<script>
    function pilihform() {
        kodekunjungan = $('#kodekunjungan').val()
        id = $('#pilihpenunjang').val()
        nomorrm = $('#nomorrm').val()
        diagx = $('#diagnosapemeriksaanpenunjang').val()
        tanggalperiksa = $('#tanggalperiksapenunjang').val()
        if (diagx == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Diagnosa tidak boleh kosong !',
                footer: ''
            })
            mysel = document.getElementById('pilihpenunjang');
            mysel.selectedIndex = 0;
        } else if (tanggalperiksa == '') {
            Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Isi tanggal periksa !',
                        footer: ''
                    })
            mysel = document.getElementById('pilihpenunjang');
            mysel.selectedIndex = 0;
        } else {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm,
                    kodekunjungan,
                    id
                },
                url: '<?= route('ambilform') ?>',
                success: function(response) {
                    $('.formnya').html(response);
                }
            });
        }
    }
    $(document).ready(function() {
        orderhari_ini()
    });

    function orderhari_ini() {
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan: $('#kodekunjungan').val()
            },
            url: '<?= route('orderhari_ini') ?>',
            error: function(data) {
                alert('ok')
            },
            success: function(response) {
                $('.riwayatorder').html(response)
            }
        });
    }
</script>
