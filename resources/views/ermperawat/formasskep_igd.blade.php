<button class="btn btn-danger mb-2" onclick="bataligd()">Kembali</button>
<div class="card">
    <div class="card-header bg-info">Assesmen Awal Keperawatan</div>
    <div class="card-body">
        <form action="" class="formpemeriksaanperawat_igd">
            {{-- <input hidden type="text" name="kodekunjungan" class="form-control" value="{{ $kunjungan[0]->kode_kunjungan }}">
            <input hidden type="text" name="counter" class="form-control" value="{{ $kunjungan[0]->counter }}">
            <input hidden type="text" name="unit" class="form-control" value="{{ $kunjungan[0]->kode_unit }}">
            <input hidden type="text" name="nomorrm" class="form-control" value="{{ $kunjungan[0]->no_rm }}"> --}}
            <table class="table">
                <tr>
                    <td class="text-bold font-italic">Kode Registrasi</td>
                    <td>
                        <div class="input-group">
                            <input readonly type="text" id="koderegistrasi" name="koderegistrasi" class="form-control" placeholder=""
                                aria-label="" aria-describedby="button-addon4">
                            <div class="input-group-append" id="button-addon4">
                                <button class="btn btn-outline-light btn-success" type="button"
                                    onclick="generatekode()"><i class="bi bi-arrow-clockwise mr-2"></i>
                                    Generate</button>
                                {{-- <button class="btn btn-outline-secondary" type="button">Button</button> --}}
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Nama Pasien</td>
                    <td><input type="text" class="form-control" name="namapasien"></td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Alamat</td>
                    <td>
                        <textarea type="text" class="form-control" name="alamat"></textarea>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Tanggal Kunjungan</td>
                    <td><input readonly name="tanggalkunjungan" class="form-control" value="{{ $date }}"></td>
                    <td class="text-bold font-italic">Tanggal Assesmen</td>
                    <td><input type="date" name="tanggalassesmen" class="form-control datepicker"
                            data-date-format="yyyy-mm-dd"></td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Sumber Data</td>
                    <td colspan="3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                value="Pasien Sendiri" checked>
                            <label class="form-check-label" for="inlineRadio1">Pasien Sendiri / Autoanamase</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sumberdata" id="sumberdata"
                                value="Keluarga">
                            <label class="form-check-label" for="inlineRadio2">Keluarga / Alloanamnesa</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-bold font-italic">Keluhan Utama</td>
                    <td colspan="3">
                        <textarea class="form-control" id="keluhanutama" name="keluhanutama" placeholder="Ketik keluhan pasien ..."></textarea>
                    </td>
                </tr>
            </table>
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Tanda - Tanda Vital</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Tekanan Darah</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tekanan darah pasien ..."
                                    aria-label="Recipient's username" id="tekanandarah" name="tekanandarah"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">mmHg</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Frekuensi Nadi</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Frekuensi nadi pasien ..."
                                    id="frekuensinadi" name="frekuensinadi" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x/menit</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Frekuensi Nafas</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Frekuensi Nafas Pasien ..."
                                    name="frekuensinafas" id="frekuensinafas" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">x/menit</span>
                                </div>
                            </div>
                        </td>
                        <td class="text-bold font-italic">Suhu</td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Suhu tubuh pasien ..."
                                    aria-label="Suhu tubuh pasien" name="suhutubuh" id="suhutubuh"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">°C</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Riwayat Psikologis</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayatpsikologis"
                                    id="riwayatpsikologis" value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayatpsikologis"
                                    id="riwayatpsikologis" value="Cemas">
                                <label class="form-check-label" for="inlineRadio2">Cemas</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayatpsikologis"
                                    id="riwayatpsikologis" value="Takut">
                                <label class="form-check-label" for="inlineRadio2">Takut</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayatpsikologis"
                                    id="riwayatpsikologis" value="Sedih">
                                <label class="form-check-label" for="inlineRadio2">Sedih</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="riwayatpsikologis"
                                    id="riwayatpsikologis" value="Lain - lain">
                                <label class="form-check-label" for="inlineRadio2">Lain - lain</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3">
                            <textarea class="form-control" id="keteranganriwayatpsikologislainnya" name="keteranganriwayatpsikologislainnya"
                                placeholder="Keterangan riwayat psikologis lain ..."></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Status Fungsional</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Penggunaan Alat Bantu</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alatbantu" id="alatbantu"
                                    value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alatbantu" id="alatbantu"
                                    value="Tongkat">
                                <label class="form-check-label" for="inlineRadio2">Tongkat</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alatbantu" id="alatbantu"
                                    value="Kursi Roda">
                                <label class="form-check-label" for="inlineRadio2">Kursi Roda</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="alatbantu" id="alatbantu"
                                    value="Lain - lain">
                                <label class="form-check-label" for="inlineRadio2">Lain - lain</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3">
                            <textarea class="form-control" name="keteranganalatbantulain" id="keteranganalatbantulain"
                                placeholder="Keterangan alat bantu lainnya ..."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic">Cacat Tubuh</td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cacattubuh" id="cacattubuh"
                                    value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="cacattubuh" id="cacattubuh"
                                    value="Ada">
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3">
                            <textarea class="form-control" placeholder="Keterangan cacat tubuh lainnya ..." id="keterangancacattubuhlainnya"
                                name="keterangancacattubuhlainnya"></textarea>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table text-sm">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Assesmen Nyeri</th>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-bold font-italic">Pasien Mengeluh Nyeri </td>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pasienmengeluhnyeri"
                                    id="pasienmengeluhnyeri" value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pasienmengeluhnyeri"
                                    id="pasienmengeluhnyeri" value="Ada">
                                <label class="form-check-label" for="inlineRadio2">Ada</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold font-italic"></td>
                        <td colspan="3">
                            <textarea class="form-control" placeholder="Keterangan skala nyeri pasien ..." name="skalanyeripasien"
                                id="skalanyeripasien"></textarea>
                            <img width="50%" src="{{ asset('public/img/skalanyeri.jpg') }}" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Assesmen Resiko Jatuh</th>
                </thead>
                <tbody>
                    <tr class="bg-secondary">
                        <td colspan="4" class="text-center text-bold font-italic">Metode Up and Go</td>
                    </tr>
                    <tr>
                        <td>Faktor Resiko</td>
                        <td>Skala</td>
                    </tr>
                    <tr>
                        <td>a</td>
                        <td>Perhatikan cara berjalan pasien saat akan duduk dikursi. Apakah pasien tampak tidak seimbang
                            (
                            sempoyongan / limbung ) ?</td>
                    </tr>
                    <tr>
                        <td>b</td>
                        <td>Apakah pasien memegang pinggiran kursi atau meja atau benda lain sebagai penopang saat akan
                            duduk ?</td>
                    </tr>
                    <tr class="bg-light">
                        <td colspan="4" class="text-center text-bold font-italic">Hasil</td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="resikojatuh" id="resikojatuh"
                                    value="Tidak Beresiko" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Beresiko ( Tidak ditemukan a
                                    dan
                                    b )</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="resikojatuh" id="resikojatuh"
                                    value="Risiko Rendah">
                                <label class="form-check-label" for="inlineRadio1"> Risiko rendah ( ditemukan a atau
                                    b)
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="resikojatuh" id="resikojatuh"
                                    value="Risiko Tinggi">
                                <label class="form-check-label" for="inlineRadio1"> Risiko tinggi ( a dan b ditemukan
                                    )
                                </label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <thead>
                    <th colspan="4" class="text-center bg-warning">Skrinning Gizi</th>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center text-bold font-italic bg-secondary">Metode Malnutrition
                            Screnning Tools ( Pasien Dewasa )</td>
                    </tr>
                    <tr class="bg-light text-bold font-italic">
                        <td colspan="3">1. Apakah pasien mengalami penurunan berat badan yang tidak diinginkan dalam
                            6
                            bulan terakhir ?
                        </td>
                        <td>Skor</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penurunanbb" id="penurunanbb"
                                    value="Tidak ada penurunan" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak ada penurunan berat badan
                                </label>
                            </div>
                        </td>
                        <td rowspan="3">
                            <textarea class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penurunanbb" id="penurunanbb"
                                    value="Tidak yakin ada penurunan">
                                <label class="form-check-label" for="inlineRadio1">Tidak yakin / tidak tahu / terasa
                                    baju lebih longgar
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="penurunanbb" id="penurunanbb"
                                    value="Ya, ada penurunan">
                                <label class="form-check-label" for="inlineRadio1">Jika YA , berapa berat badan
                                    tersebut
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="Tidak" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak</label>
                                <input class="form-check-input ml-2" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1 - 5 Kg</label>
                                <input class="form-check-input  ml-2" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="option1">
                                <label class="form-check-label" for="inlineRadio1">6 - 10 Kg</label>
                                <input class="form-check-input  ml-2" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="option1">
                                <label class="form-check-label" for="inlineRadio1">11 - 15 Kg</label>
                                <input class="form-check-input  ml-2" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="option1">
                                <label class="form-check-label" for="inlineRadio1">> 15 Kg</label>
                                <input class="form-check-input  ml-2" type="radio" name="beratpenurunan"
                                    id="beratpenurunan" value="option1">
                                <label class="form-check-label" for="inlineRadio1">Tidak Yakin Penurunannya</label>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-light text-bold font-italic">
                        <td colspan="4">2. Apakah asupan makanan berkurang karena berkurangnya nafsu makan</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asupanmakanan"
                                    id="asupanmakanan" value="Tidak Ada" checked>
                                <label class="form-check-label" for="inlineRadio1">Tidak Ada
                                </label>
                            </div>
                        </td>
                        <td rowspan="2">
                            <textarea class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="asupanmakanan"
                                    id="asupanmakanan" value="Ada">
                                <label class="form-check-label" for="inlineRadio1"> Ada
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr class="bg-light text-bold font-italic">
                        <td colspan="3">Total Skor</td>
                        <td><input class="form-control"></td>
                    </tr>
                </tbody>
            </table>
            <table class="table">
                <tr>
                    <td class="bg-light text-bold font-italic" colspan="4">3. Pasien dengan diagnosa khusus :
                        Penyakit DM / Ginjal / Hati / Paru / Stroke /
                        Kanker / Penurunan
                        imunitas geriatri, lain lain...</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="diagnosakhusus" id="diagnosakhusus"
                                value="Tidak Ada" checked>
                            <label class="form-check-label" for="inlineRadio1">Tidak Ada
                            </label>
                            <input class="form-check-input ml-2" type="radio" name="diagnosakhusus"
                                id="diagnosakhusus" value="Tidak Ada">
                            <label class="form-check-label" for="inlineRadio1"> Ada
                            </label>
                        </div>
                    </td>
                    <td><input type="text" class="form-control" placeholder="Keterangan diagnosa lain ..."
                            name="keterangandiagnosalain"></td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <td class="bg-light text-bold font-italic" colspan="4">4. Bila skor >= 2, pasien beresiko
                        malnutrisi dilakukan pengkajian lanjut oleh ahli gizi</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="kajianlanjutgizi"
                                id="kajianlanjutgizi" value="Tidak Ada" checked>
                            <label class="form-check-label" for="inlineRadio1">Tidak Ada
                            </label>
                            <input class="form-check-input ml-2" type="radio" name="kajianlanjutgizi"
                                id="kajianlanjutgizi" value="Ada">
                            <label class="form-check-label" for="inlineRadio1">Ada
                        </div>
                    </td>
                    <td><input type="text" class="form-control" name="tglpengkajianlanjut"
                            id="tglpengkajianlanjut"></td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <td colspan="4" class="text-center bg-info">Diagnosa Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" placeholder="Masukan diagnosa keperawatan ..." name="diagnosakeperawatan"
                            id="diagnosakeperawatan"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Rencana Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" placeholder="Masukan rencana keperawatan" id="rencanakeperawatan"
                            name="rencanakeperawatan"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Tindakan Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" placeholder="Masukan tindakan keperawatan" id="tindakankeperawatan"
                            name="tindakankeperawatan"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-center bg-info">Evaluasi Keperawatan/Kebidanan</td>
                </tr>
                <tr>
                    <td>
                        <textarea class="form-control" placeholder="Masukan evaluasi keperawatan" name="evaluasikeperawatan"
                            id="evaluasikeperawatan"></textarea>
                    </td>
                </tr>
            </table>
            <button type="button" class="btn btn-danger float-right ml-2">Batal</button>
            <button type="button" class="btn btn-success float-right" onclick="simpanhasil()">Simpan</button>
        </form>
    </div>
</div>
<script>
    function generatekode() {
        kodeinput = $('#koderegistrasi').val()
        if (kodeinput == '') {
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('generatekode_igd') ?>',
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
                        $('#koderegistrasi').val(data.kode)
                    }
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: 'Kode sudah digenerate !',
                footer: ''
            })
        }

    }
    function simpanhasil() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formpemeriksaanperawat_igd').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaanperawat_igd') ?>',
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
                }
            }
        });
    }
</script>
