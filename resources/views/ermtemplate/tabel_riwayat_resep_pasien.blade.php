@foreach ($header as $h)
    @if ($h->dok_kirim == auth()->user()->kode_paramedis)
        <div class="card">
            <div class="card-header">{{ $h->tgl_entry }} | {{ $h->unit_pengirim }} | {{ $h->nama_dokter }} | <button class="btn btn-success pakairesep" idheader="{{ $h->id }}"><i class="bi bi-check2-square"></i> Pakai Resep</button></div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Nama Barang </th>
                        <th>Qty</th>
                        <th>Aturan Pakai</th>
                    </thead>
                    <tbody>
                        @foreach ($resep as $d)
                            @if ($d->row_id_header == $h->id)
                                <tr>
                                    <td>{{ $d->kode_barang }}</td>
                                    <td>{{ $d->jumlah_layanan }}</td>
                                    <td>{{ $d->aturan_pakai }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endforeach
<script>
     $(".pakairesep").on('click', function(event) {
        idheader = $(this).attr('idheader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idheader
            },
            url: '<?= route('ambilresep_detail2') ?>',
            error: function(response) {
                spinner.hide();
                alert('error')
            },
            success: function(response) {
                $('.formobatfarmasiriwayat').html(response);
                $('#modaltemplate').modal('hide')
                spinner.hide();
            }
        });
    });
</script>
