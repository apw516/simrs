@foreach ($header as $h)
    <div class="card">
        <div class="card-header bg-light">{{ $h->nama_resep }}
            <button class="btn btn-success float-right pilihreseptemplate" idtemplate="{{ $h->id }}"><i class="bi bi-plus mr-2"></i> Pilih Resep</button>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered">
                <thead>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Aturan Pakai</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    @foreach ($detail as $d)
                    @if($d->id_header == $h->id)
                    <tr>
                        <td>{{ $d->nama_barang}}</td>
                        <td>{{ $d->qty}}</td>
                        <td>{{ $d->aturan_pakai}}</td>
                        <td>{{ $d->jenis}}</td>
                        <td>{{ $d->keterangan}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
<script>
    $(".pilihreseptemplate").on('click', function(event) {
        id = $(this).attr('idtemplate')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('v2_add_riwayat_template_pemakaian_obat') ?>',
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
