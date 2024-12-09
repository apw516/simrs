<table id="tabelresetemplatepdokter" class="table table-bordered">
    <thead>
        <th>Resep</th>
    </thead>
    <tbody>
        @foreach ($header as $h)
            <tr>
                <td>
                    <div class="card">
                        <div class="card-header bg-info">Nama Resep : {{ $h->nama_resep }} | {{ $h->nama_dokter }} | {{ $h->tgl_entry }} <button type="button" class="btn btn-warning float-right pilitemplate" idheader="{{ $h->id }}"><i class="bi bi-plus"></i> Pakai</button>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <th>Nama Obat</th>
                                    <th>Aturan Pakai</th>
                                    <th>Jumlah</th>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $d)
                                        @if ($d->id_resep_header == $h->id)
                                            <tr>
                                                <td>{{ $d->nama_barang }}</td>
                                                <td>{{ $d->aturan_pakai }}</td>
                                                <td>{{ $d->qty }}</td>
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
        $("#tabelresetemplatepdokter").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 2,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilitemplate").on('click', function(event) {
        Swal.fire({
            title: "Template Resep dipilih untuk digunakan ?",
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
        $('#modalriwayatresep').modal('hide')
        var max_fields = 10;
        // var wrapper = $(".input_komponen_obat_racik");
        var wrapper = $(".draft_obat_yang_diorder2");
        var x = 1;
        if (x < max_fields) {
            x++; //text box increment
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id
                },
                url: '<?= route('ambil_detail_template_resep') ?>',
                success: function(response) {
                    // wrapper.after(html);
                    // $('#daftarpxumum').attr('disabled', true);
                    $(wrapper).append(response);
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                    $('#modaltemplateresepdokter').modal('toggle');
                    spinner.hide();
                }
            });
        }
    }

