<div class="card mt-4">
    <div class="card-header bg-info">Riwayat Kunjungan</div>
    <div class="card-body">
        <table id="tabelriwayatkunjungan" class="table table-bordered table-sm text-xs table-hover table-striped">
            <thead>
                <th>Nama</th>
                <th>Unit</th>
                <th>Tgl Masuk</th>
                <th class="text-xs">Tgl Keluar</th>
                <th class="text-xs">PENJAMIN</th>
                <th>Status</th>
                <th>catatan</th>
                <th>Dokter</th>
                <th>SEP</th>
                <th>Rujukan</th>
                <th>action</th>
            </thead>
            <tbody>
                @foreach ($riwayat_kunjungan as $r)
                    <tr>
                        <td>{{ $r->nama_px }}</td>
                        <td class="text-xs">{{ $r->nama_unit }}</td>
                        <td class="text-xs"><button class="badge badge-warning">{{ $r->tgl_masuk }}</button></td>
                        <td>{{ $r->tgl_keluar }}</td>
                        <td class="text-xs">{{ $r->nama_penjamin }}</td>
                        <td class="text-xs">
                            @if ($r->status_kunjungan == 1)
                                aktif
                            @elseif($r->status_kunjungan == 2)
                                selesai
                            @elseif($r->status_kunjungan == 8 || $r->status_kunjungan == 11)
                                batal
                            @endif
                        </td>
                        <td class="text-xs">{{ $r->CATATAN }}</td>
                        <td class="text-xs">{{ $r->dokter }}</td>
                        <td class="text-xs">{{ $r->no_sep }}</td>
                        <td class="text-xs">
                            <p class="font-weight-bold">{{ $r->no_rujukan }} </p>
                        </td>
                        <td>
                            <button rm="{{ $r->no_rm }}" kode="{{ $r->kode_kunjungan }}" sep="{{ $r->no_sep }}"
                                rujukan="{{ $r->no_rujukan }}" status=" {{ $r->status_kunjungan }}"
                                kronis=" {{ $r->CATATAN }}" class="badge badge-warning text-md editkunjungan"
                                data-toggle="modal" data-target="#modaleditkunjungan" title="edit kunjungan..."><i
                                    class="bi bi-pencil-square"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="formsepmanual">

</div>

<!-- Modal -->
<div class="modal fade" id="modaleditkunjungan" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="editkunjunganform">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button @if(auth()->user()->hak_akses != 1 )
                     disabled @endif type="button" class="btn btn-primary" onclick="simpaneditkunjungan()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabelriwayatkunjungan").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "pageLength": 5,
            "searching": true,
            "ordering": true,
            "columnDefs": [{
                "targets": 0,
                "type": "date"
            }],
            // "order": [
            //     [1, "desc"]
            // ]
        })
    });
    $('#tabelriwayatkunjungan').on('click', '.editkunjungan', function() {
        spinner = $('#loader');
        spinner.show();
        rm = $(this).attr('rm')
        kode = $(this).attr('kode')
        sep = $(this).attr('sep')
        rujukan = $(this).attr('rujukan')
        status = $(this).attr('status')
        kronis = $(this).attr('kronis')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode,
                sep,
                rujukan,
                status,
                kronis
            },
            url: '<?= route('formedit_kunjungan') ?>',
            error: function(data) {
                spinner.hide();
            },
            success: function(response) {
                spinner.hide();
                $('.editkunjunganform').html(response);
            }
        });
    });

    function simpaneditkunjungan() {
        spinner = $('#loader');
        spinner.show();
        kode = $('#kodekunjungan').val()
        nomorrm = $('#nomorrm').val()
        nomorsep = $('#nomorsep').val()
        nomorrujukan = $('#nomorrujukan').val()
        kronis = $('#kronis').val()
        status_kunjungan = $('#status_kunjungan').val()
        $.ajax({
            type: 'post',
            async: true,
            dataType: 'Json',
            data: {
                _token: "{{ csrf_token() }}",
                kode,
                nomorrm,
                nomorsep,
                nomorrujukan,
                kronis,
                status_kunjungan
            },
            url: '<?= route('savedit_kunjungan') ?>',
            error: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops sepertinya ada masalah ...',
                })
            },
            success: function(data) {
                spinner.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Kunjungan berhasil diupdate...',
                })
                location.reload()
            }
        });


    }
</script>
