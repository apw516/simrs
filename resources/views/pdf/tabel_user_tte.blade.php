<table class="table table-sm table-bordered" id="tabeluser">
    <thead>
        <th>NIP</th>
        <th>NIK</th>
        <th>Nama</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->nip }}</td>
                <td>{{ $d->nik }}</td>
                <td>{{ $d->nama_paramedis }}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-info cekstatus" nik="{{ $d->nik }}" data-toggle="modal"
                        data-target="#modalstatususer">Cek
                        Status</button>
                    <button class="btn btn-sm btn-success registrasi" nik="{{ $d->nik }}" data-toggle="modal"
                        data-target="#modalregis">Registrasi</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modalstatususer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="v_status">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalregis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrasi User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-md">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Surat Rekomendasi</label>
                        <input type="file" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIK</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">NIP</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nomor Telp</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Kota</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Provinsi</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Jabatan</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Unit Kerja</label>
                        <input type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Image TTD</label>
                        <input type="file" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">KTP</label>
                        <input type="file" class="form-control" id="exampleInputPassword1">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Registrasi</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabeluser").DataTable({
            "responsive": false,
            "lengthChange": false,
            // "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $(".cekstatus").on('click', function(event) {
        nik = $(this).attr('nik')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                nik
            },
            url: '<?= route('cekstatususer') ?>',
            error: function(response) {
                spinner.hide()
                alert('error')
            },
            success: function(response) {
                $('.v_status').html(response);
                spinner.hide()
            }
        });
    });
