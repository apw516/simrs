<table id="tableuser_id"class="table table-sm table-hover table-bordered">
    <thead>
        <th hidden>id</th>
        <th>Username</th>
        <th>Nama</th>
        <th>Hak akses</th>
        <th>unit</th>
        <th>Kode Paramedis</th>
    </thead>
    <tbody>
        @foreach ($datauser as $d)
            <tr class="edit" id="{{ $d->id }}" data-toggle="modal" data-target="#modaledituser">
                <td hidden >{{ $d->id }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->hak_akses }}</td>
                <td>{{ $d->nama_unit }}</td>
                <td>{{ $d->kode_paramedis }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modaledituser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-edit-user">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpanedit()">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tableuser_id").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order":['0',"desc"]
        })
    });
    $('#tableuser_id').on('click', '.edit', function() {
        spinner = $('#loader')
        spinner.show();
        id = $(this).attr('id')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id
            },
            url: '<?= route('ambildatauser_edit') ?>',
            error: function(response) {
                spinner.hide()
            },
            success: function(response) {
                $('.form-edit-user').html(response);
                spinner.hide();
            }
        });
    });

    function simpanedit() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formedit_usersimrs').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanedit_user') ?>',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah......',
                    footer: ''
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message,
                        footer: ''
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'OK',
                        text: data.message,
                        footer: ''
                    })
                }
                $('#modaledituser').modal('hide')
                ambildatauser()
            }
        });
    }
</script>
