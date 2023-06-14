<table id="tabeltemplate" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Detail Resep</th>
        <th>---</th>
    </thead>
    <tbody>
        @foreach ($resep as $r)
            <tr>
                <td>{{ $r->keterangan }}</td>
                <td>
                    <button class="badge badge-info pilihresep" kode="{{ $r->keterangan }}">Pilih</button>
                    <button class="badge badge-danger hapusresep" kode="{{ $r->id }}">hapus</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeltemplate").DataTable({
            "responsive": false,
            "lengthChange": false,
            "pageLength": 10,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
    });
    $('#tabeltemplate').on('click', '.pilihresep', function() {
        id = $(this).attr('kode')
        reseplama = $('#resepobat').val()
        count = reseplama.trim().length
        if(count > 0){
            resepbaru = reseplama + '\n' + id
        }else{
            resepbaru = id
        }
        $('#resepobat').val(resepbaru)
        $('#modaltemplate').modal('hide')
    });
    $('#tabeltemplate').on('click', '.hapusresep', function() {
        id = $(this).attr('kode')
        Swal.fire({
            title: 'Hapus template resep ?',
            text: "Anda akan menghapus template yang dipilih ...",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ya, hapus !'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id,
                    },
                    url: '<?= route('hapustemplateresep') ?>',
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
                            Swal.fire(
                                'Berhasil !',
                                'Template berhasil dihapus ...',
                                'success'
                            )
                            $('#modaltemplate').modal('hide')
                        }
                    }
                });
            }
        })
    });
</script>
