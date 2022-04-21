<table id="tabelpasienbaru" class="table table-bordered table-sm">
    <thead>
        <th>Nomor RM</th>
        <th>NIK</th>
        <th>No BPJS</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($data_pasien as $p)
            <tr>
                <td>{{ $p->no_rm }}</td>
                <td>{{ $p->NIK }}</td>
                <td>{{ $p->no_asuransi }}</td>
                <td>{{ $p->nama_pasien }}</td>
                <td>{{ $p->alamat }}</td>
                <td>
                    <button class="badge badge-warning editpasien" namapasien_edit="{{ $p->nama_pasien }}"
                        nomorktp_edit="{{ $p->NIK }}" nomorbpjs_edit="{{ $p->no_asuransi }}"
                        rm="{{ $p->no_rm }}" data-toggle="modal" data-target="#editpasien"><i class="bi bi-pencil-square"></i></button>
                    <button class="badge badge-primary daftarumum" rm="{{ $p->no_rm }}"
                        nik="{{ $p->NIK }}">Umum</button>
                    <button class="badge badge-success daftarbpjs" rm="{{ $p->no_rm }}"
                        noka="{{ $p->no_asuransi }}">Bpjs</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(".preloader").fadeOut();
    $(function() {
        $("#tabelpasienbaru").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,

        })
    });
    $('#tabelpasienbaru').on('click', '.daftarbpjs', function() {
        spinner = $('#loader')
        spinner.show();
        nomorrm = $(this).attr('rm')
        nomorbpjs = $(this).attr('noka')
        if (nomorbpjs == '' || nomorbpjs == '0') {
            spinner.hide()
            Swal.fire({
                icon: 'warning',
                title: 'Oops,silahkan coba lagi',
                text: 'Nomor Kartu Belum diisi ...'
            })
        } else {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    nomorrm,
                    nomorbpjs
                },
                url: '<?= route('formbpjs') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.formpasien').html(response)
                }
            });
        }
    });
</script>
