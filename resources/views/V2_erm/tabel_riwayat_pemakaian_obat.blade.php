@foreach ($ts_kunjungan_list as $kl)
    <div class="card">
        <div class="card-header bg-info">{{ $kl->unit }} | {{ $kl->tgl_masuk }} | {{ $kl->nama_dokter }} <button
                class="btn btn-warning float-right text-bold pilihresep" rm="{{ $kl->no_rm }}" idheader="{{ $kl->id_header }}" kodekunjungan="{{ $kl->kode_kunjungan}}"><i
                    class="bi bi-plus mr-2"></i> Pilih</button></div>
        <div class="card-body">
            <table id="tb_r_pemakaian_obat" class="table table-sm table-bordered table-hover table-stripped">
                <thead class="bg-light">
                    <th>Tgl entry</th>
                    <th>Dokter Pengirim</th>
                    <th>Unit Pengirim</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                </thead>
                <tbody>
                    @foreach ($riwayat_pemakaian as $k)
                        @if ($kl->kode_kunjungan == $k->kode_kunjungan)
                            <tr>
                                <td>{{ $k->tgl_masuk }}</td>
                                <td>{{ $k->nama_dokter }}</td>
                                <td>{{ $k->unit_asal }}</td>
                                <td>{{ $k->nama_barang }}</td>
                                <td class="text-center">{{ $k->jumlah_layanan }}</td>
                                <td>{{ $k->aturan_pakai }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
<script>
    $(".pilihresep").on('click', function(event) {
        id = $(this).attr('idheader')
        rm = $(this).attr('rm')
        kodekunjungan = $(this).attr('kodekunjungan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id,rm,kodekunjungan
            },
            url: '<?= route('v2_add_riwayat_pemakaian_obat') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(response, data) {
                spinner.hide()
                var wrapper = $(".field_order_farmasi");
                $('#riwayatpemakaianobatmodal').modal('hide');
                $(wrapper).append(response);
                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            }
        });
    });
</script>
