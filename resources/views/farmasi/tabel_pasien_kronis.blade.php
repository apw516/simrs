<div class="card">
    <div class="card-header">DATA PASIEN</div>
    <div class="card-body">
        <table id="tabelpasienkronis" class="table table-sm table-hover text-xs">
            <thead>
                <th>tgl kunjungan</th>
                <th>Nomor RM</th>
                <th>Nomor SEP</th>
                <th>Nama Pasien</th>
                <th width="20%">Alamat</th>
                <th>Unit</th>
                <th>Status</th>
                <th></th>
            </thead>
            <tbody>
                @foreach ($sk as $d)
                    <tr class="pilihpasien" kodekunjungan="{{ $d->kode_kunjungan }}">
                        <td>{{ $d->tgl_masuk }}</td>
                        <td>{{ $d->no_rm }}</td>
                        <td>{{ $d->no_sep }}</td>
                        <td>{{ $d->nama_pasien }}</td>
                        <td class="text-xs">{{ $d->alamat }}</td>
                        <td>{{ $d->nama_unit }}</td>
                        <td>{{ $d->catatan }}</td>
                        <td>
                            <button class="btn btn-info btn-sm pilihpasien1" rm="{{ $d->no_rm }}" sep="{{ $d->no_sep}}" kodekunjungan="{{ $d->kode_kunjungan }}" data-toggle="tooltip" data-placement="top" title="Berkas"><i class="bi bi-journal-check"></i></button>
                            <button class="btn btn-danger btn-sm pilihpasien2 mr-1 ml-1" rm="{{ $d->no_rm }}" sep="{{ $d->no_sep}}" kodekunjungan="{{ $d->kode_kunjungan }}" data-toggle="tooltip" data-placement="top" title="Berkas scan"><i class="bi bi-upc-scan"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<style>
    .modal-xxl {
        max-width: 80%;
    }
</style>
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xxl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_detail">

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
        $("#tabelpasienkronis").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $('#tabelpasienkronis').on('click', '.pilihh', function() {
        kodekunjungan = $(this).attr('kodekunjungan')
        sep = $(this).attr('sep')
        rm = $(this).attr('rm')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,sep,rm
            },
            url: '<?= route('cari_detail_pasien_kronis') ?>',
            success: function(response) {
                $('.v_detail').html(response);
                spinner.hide()
            }
        });
    });
    $('#tabelpasienkronis').on('click', '.pilihpasien1', function() {
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('mergerpdf/' + kodekunjungan);
    });
    $('#tabelpasienkronis').on('click', '.pilihpasien2', function() {
        rm = $(this).attr('rm')
        window.open('berkasscan/' + rm);
    });
</script>
