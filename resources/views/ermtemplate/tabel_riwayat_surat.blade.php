<table id="tabelsurat" class="table table-sm table-bordered">
    <thead>
        <th>Tanggal entry</th>
        <th>Unit Tujuan</th>
        <th>Keterangan</th>
        <th>Jenis</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($cek as $c )
            <tr>
                <td>{{ $c->tanggal_surat}}</td>
                <td>{{ $c->namaunittujuan}}</td>
                <td>{{ $c->keterangan}}</td>
                <td>{{ $c->jenis_surat}}</td>
                <td>
                    <button class="btn btn-info detail" iddokumen="{{ $c->id }}" data-toggle="modal" data-target="#modaldetail"><i class="bi bi-ticket-detailed"></i></button>
                    <button class="btn btn-danger hapus" iddokumen="{{ $c->id }}"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="modaldetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail surat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="v_detailsurat">

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
        $("#tabelsurat").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $(".detail").on('click', function(event) {
        iddokumen = $(this).attr('iddokumen')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                iddokumen
            },
            url: '<?= route('detailsuratpengantar') ?>',
            success: function(response) {
                $('.v_detailsurat').html(response);
                spinner.hide()
            }
        });
    });