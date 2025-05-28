<button class="btn btn-danger mb-4" onclick="kembali()"><i class="bi bi-backspace mr-1 ml-1"></i> Kembali</button>
<div class="card">
    <div class="card-header">
        Nomor RM : {{ $header[0]->no_rm }} <br>
        Nama Pasien : {{ $header[0]->nama_pasien }} <br>
        Unit Asal : {{ $header[0]->nama_unit_asal }} <br>
        Tanggal Kirim Order : {{ $header[0]->tanggal_kirim }}
        <input hidden type="text" value="{{$header[0]->kondekunjungannya}}" id="kodekunjungan">
    </div>
    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0 ">
                        <button class="btn btn-link btn-block text-left collapsed text-dark text-bold" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            <i class="bi bi-folder-plus mr-2 ml-2"></i> Riwayat resep yang sudah dilayani
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">List Obat Yang diorder</div>
            <div class="card-body">
                @if(count($dataorder2) == 0)
                    <h5 class="text-danger">Tidak ada obat yang dipilih ...</h5>
                @endif
                <form action="" method="post" class="formourderobat">
                    <div class="draft_obat2">
                        <div>
                            @foreach ($dataorder2 as $d)
                                <div class="form-row text-md">
                                    <div class="form-group col-md-2 text-md"><label for="">Tipe
                                            Anestesi</label> <select class="form-control" id="tipeanestesi"
                                            name="tipeanestesi">
                                            <option value="REG" @if ($d['tipeanestesi'] == 'REG') selected @endif>
                                                REGULER</option>
                                            <option value="KRONIS" @if ($d['tipeanestesi'] == 'KRONIS') selected @endif>
                                                KRONIS</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1"><label for="">Jumlah</label><input
                                            type="" class="form-control  text-md edit_field" id="jumlah"
                                            name="jumlah" value="{{ $d['jumlah'] }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="">Nama Barang</label>
                                        <input readonly type="" class="form-control  text-md edit_field"
                                            id="namabarang" name="namabarang" value="{{ $d['namabarang'] }}">
                                        <input hidden readonly type="" class="form-control " id="kodebarang"
                                            name="kodebarang" value="{{ $d['kodebarang'] }}">
                                        <input hidden readonly type="" class="form-control " id="kodebarang"
                                            name="idantrianheader" value="{{ $d['id_antrian'] }}">
                                        <input hidden readonly type="" class="form-control " id="kodebarang"
                                            name="idheaderorder" value="{{ $d['id_header_order'] }}">
                                        <input hidden readonly type="" class="form-control " id="kodebarang"
                                            name="iddetailorder" value="{{ $d['id_detail_order'] }}">
                                        <input hidden readonly type="" class="form-control " id="jenisresep"
                                            name="jenisresep" value="{{ $d['jenisresep'] }}">
                                    </div>
                                    <div class="form-group col-md-1"><label for="">Dosis</label>
                                        <input readonly type="" class="form-control  text-md edit_field"
                                            id="dosis" name="dosis" value="{{ $d['dosis'] }}">
                                    </div>
                                    <div class="form-group col-md-1"><label for="">Stok</label>
                                        <input readonly type="" class="form-control  text-md edit_field"
                                            id="stok" name="stok" value="{{ $d['stok'] }}">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <label for="">Sediaan</label><input readonly type=""
                                            class="form-control  text-md edit_field" id="sediaan" name="sediaan"
                                            value="{{ $d['sediaan'] }}">
                                    </div>
                                    <div class="form-group col-md-3"><label for="">Aturan Pakai</label>
                                        <textarea type="" cols="3" rows="3" class="form-control  text-md edit_field" id="aturanpakai"
                                            name="aturanpakai">{{ $d['aturanpakai'] }}</textarea>
                                    </div>
                                    <i class="bi bi-x-square remove_field form-group col-md-1 text-danger"
                                        kode2=""></i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace mr-1 ml-1"></i>
                    Kembali</button>
                <button class="btn btn-success" onclick="simpanpelayanan()"><i
                        class="bi bi-bookmarks-fill mr-1 ml-1"></i> Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    function kembali() {
        $('.v_1').removeAttr('hidden', true)
        $('.v_2').attr('hidden', true)
    }
    $('.draft_obat2').on("click", ".remove_field", function(e) { //user click on remove
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })

    function simpanpelayanan() {
        Swal.fire({
            title: "Anda Yakin ?",
            text: "Pastikan obat yang dipilih sudah benar ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, simpan !"
        }).then((result) => {
            if (result.isConfirmed) {
                simpanpemakaianobat()
            }
        });
    }

    function simpanpemakaianobat() {
        spinneron()
        var data = $('.formourderobat').serializeArray();
        kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),kodekunjungan
            },
            url: '<?= route('simpandatapelayanan') ?>',
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
