<table id="tabelriwayatracikan" class="table table-sm table-hover">
    <thead>
        <th>Nama Racikan</th>
        <th>Tipe Racikan</th>
        <th>Kemasan Racikan</th>
        <th>QTY</th>
        <th>Aturan Pakai</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        @foreach ($dataracikan as $dr )
            <tr>
                <td>{{ $dr->nama_racikan }}</td>
                <td>{{ $dr->display_tipe }}</td>
                <td>{{ $dr->display_kemasan }}</td>
                <td>{{ $dr->qty }}</td>
                <td>{{ $dr->aturan_pakai }}</td>
                <td width="40%" class="font-italic">
                    {{
                        $onlyconsonants = str_replace('|', ",", $dr->keterangan);
                    }}
                    <button type="button" class="badge badge-success pilihracikan" idracik = {{ $dr->id }}><i class="bi bi-check2-square"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatracikan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "ordering": false,
        })
    });
    $(".pilihracikan").on('click', function(event) {
        Swal.fire({
            title: "Pilih Racikan ?",
            text: "Klik OK untuk melanjutkan ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                idheader = $(this).attr('idracik')
                cari_detail_resepnya(idheader)
            }
        });
    });
    function cari_detail_resepnya(id) {
        spinner = $('#loader')
        spinner.show();
        var max_fields = 10;
        // var wrapper = $(".input_komponen_obat_racik");
        var wrapper = $(".draft_obat");
        var x = 1;
        if (x < max_fields) {
            x++; //text box increment
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id
                },
                url: '<?= route('ambil_detail_racikan') ?>',
                success: function(response) {
                    // wrapper.after(html);
                    // $('#daftarpxumum').attr('disabled', true);
                    $(wrapper).append(response);
                    $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    })
                    $('#modaltemplateracikandokter').modal('toggle');
                    spinner.hide();
                }
            });
        }
    }
