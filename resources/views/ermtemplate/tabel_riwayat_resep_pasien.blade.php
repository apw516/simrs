@foreach ($header as $h)
    {{-- @if ($h->dok_kirim == auth()->user()->kode_paramedis) --}}
        <div class="card">
            <div class="card-header">{{ $h->tgl_masuk }} | {{ $h->nama_unit }} | {{ $h->nama_dokter }} | <button class="btn btn-success pakairesep" idheader="{{ $h->id_layanan_header }}"><i class="bi bi-check2-square"></i> Pakai Resep</button></div>
            <div class="card-body">
                <table class="table table-sm table-bordered">
                    <thead>
                        <th>Nama Barang </th>
                        <th>Qty</th>
                        <th>Aturan Pakai</th>
                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            @if ($d->id_header == $h->id_layanan_header)
                                <tr>
                                    <td>{{ $d->nama_barang }}</td>
                                    <td>{{ $d->jumlah_layanan }}</td>
                                    <td>{{ $d->aturan_pakai }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    {{-- @endif --}}
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
            url: '<?= route('ambilresep_detail3') ?>',
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
