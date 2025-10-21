<table id="tabelriwayat" class="table table-sm table-hover table-bordered">
    <thead>
        <th>tgl entry</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Alamat</th>
        <th>Unit Pengirim</th>
        <th>Dokter Pengirim</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($riwayat as $r)
            <tr>
                <td>{{ $r->tgl_entry }}</td>
                <td>{{ $r->rm }}</td>
                <td>{{ $r->nama_pasien }}</td>
                <td>{{ $r->alamat }}</td>
                <td>{{ $r->unit_pengirim }}</td>
                <td>{{ $r->nama_dokter }}</td>
                <td>
                    <button class="btn btn-info detaillayanan" idheader="{{ $r->id_layanan_header }}" data-toggle="modal"
                        data-target="#modaldetaillayanan"><i class="bi bi-ticket-detailed"></i></button>
                    <button class="btn btn-success layani" idheader="{{ $r->id_layanan_header }}"><i class="bi bi-folder-plus"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetaillayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Layanan Farmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail_layanan">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabelriwayat").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "ordering": false,
        })
    });
    $(".detaillayanan").on('click', function(event) {
        idheader = $(this).attr('idheader')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idheader
            },
            url: '<?= route('detaillayananfarmasi') ?>',
            success: function(response) {
                spinner.hide();
                $('.v_detail_layanan').html(response);
            }
        });
    });
    $(".layani").on('click', function(event) {
            idorder = $(this).attr('idheader')
            $('.v_1').attr('hidden', true)
            $(".v_2").removeAttr('hidden', true);
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    idorder
                },
                url: '<?= route('detailorderan2') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_2').html(response);
                }
            });
        })