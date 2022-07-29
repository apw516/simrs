<div class="card mt-4">
    <div class="card-header bg-info">Riwayat Kunjungan</div>
    <div class="card-body">
        <table id="tabelriwayatkunjungan"
            class="table table-bordered table-sm text-xs table-hover table-striped">
            <thead>
                <th>Nama</th>
                <th>Unit</th>
                <th>Tgl Masuk</th>
                <th class="text-xs">Tgl Keluar</th>
                <th class="text-xs">PENJAMIN</th>
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
                        <td class="text-xs">{{ $r->dokter }}</td>
                        <td class="text-xs">{{ $r->no_sep }}</td>
                        <td class="text-xs"><p class="font-weight-bold">{{ $r->no_rujukan }} </p></td>
                        <td>                            
                            <button rm="{{ $r->no_rm }}" kode="{{ $r->kode_kunjungan }}" class="badge badge-warning text-md editkunjungan" data-toggle="modal" data-target="#modaleditkunjungan" title="edit kunjungan..."><i class="bi bi-pencil-square"></i></button>
                            <button rm="{{ $r->no_rm }}" kode="{{ $r->kode_kunjungan }}" class="badge badge-success text-md tutupkunjungan" data-toggle="tooltip" title="Tutup kunjungan..."><i class="bi bi-door-closed-fill"></i></button>
                            <button rm="{{ $r->no_rm }}" kode="{{ $r->kode_kunjungan }}" class="badge badge-danger text-md batalkunjungan" data-toggle="tooltip..." title="Batal kunjungan"><i class="bi bi-x-square-fill"></i></button>
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
<div class="modal fade" id="modaleditkunjungan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Kunjungan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
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
    $('#tabelriwayatkunjungan').on('click', '.batalkunjungan', function() {
        Swal.fire({
            title: 'Batal kunjungan',
            text: "Kunjungan akan dibatalkan ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batal kunjungan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.hide()
             
            }
        });
    });
    $('#tabelriwayatkunjungan').on('click', '.tutupkunjungan', function() {
        Swal.fire({
            title: 'Tutup kunjungan',
            text: "Input layanan rawat jalan atau rawat inap akan ditutup..",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Tutup kunjungan',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.hide()
             
            }
        });
    });
    $('#tabelriwayatkunjungan').on('click', '.buatsep', function() {
        spinner = $('#loader');
        spinner.show();
        rm = $(this).attr('rm')
        kode = $(this).attr('kode')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                rm,
                kode
            },
            url: '<?= route('formbuatsep_manual') ?>',
            error: function(data) {
                spinner.hide();
            },
            success: function(response) {
                spinner.hide();
                $('.formsepmanual').html(response);
            }
        });
    });
</script>