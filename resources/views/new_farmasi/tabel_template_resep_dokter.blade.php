<table id="tabeltemplateresep" class="table table-bordered">
    <thead>
        <th>Resep</th>
    </thead>
    <tbody>
        @foreach ($header as $h)
            <tr>
                <td>
                    <div class="card">
                        <div class="card-header bg-info">Resep : {{ $h->nama_template }} | {{ $h->nama_dokter }}
                            | {{ $h->tgl_entry }} <button type="button" class="btn btn-warning float-right pilihtemplate" idheader="{{ $h->id}}"><i class="bi bi-plus"></i> Pakai</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>Nama Obat</th>
                                    <th>Tipe anestesi</th>
                                    <th>Jenis Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Jumlah</th>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $d)
                                        @if ($d->id_header == $h->id)
                                            <tr>
                                                <td>{{ $d->namabarang }}</td>
                                                <td>{{ $d->tipeanestesi }}</td>
                                                <td>{{ $d->jenisresep }}</td>
                                                <td>{{ $d->aturanpakai }}</td>
                                                <td>{{ $d->jumlah }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeltemplateresep").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihtemplate").on('click', function(event) {
        Swal.fire({
            title: "Template dipilih untuk digunakan ?",
            text: "Klik OK untuk melanjutkan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                idheader = $(this).attr('idheader')
                cari_detail_resepnya(idheader)
            }
        });
    });
    function cari_detail_resepnya(id) {
        spinner = $('#loader')
        spinner.show();
        var max_fields = 10;
        // var wrapper = $(".input_komponen_obat_racik");
        var wrapper = $(".draft_obat2");
        var x = 1;
        if (x < max_fields) {
            x++; //text box increment
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id
                },
                url: '<?= route('ambil_detail_template') ?>',
                success: function(response) {
                    // wrapper.after(html);
                    // $('#daftarpxumum').attr('disabled', true);
                    $(wrapper).append(response);
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                    spinner.hide();
                    $('#modalriwayatreseppasien').modal('hide')
                    $('#modalriwayatrespdokter').modal('hide')
                }
            });
        }
    }

