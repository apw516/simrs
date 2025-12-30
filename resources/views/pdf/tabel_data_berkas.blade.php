<table class="table table-sm table-bordered text-xs" id="tabeldatatte">
    <thead>
        <th>Tanggal Kirim</th>
        <th>Nomor RM</th>
        <th>Nama Pasien</th>
        <th>Unit</th>
        <th>Dokter</th>
        <th>File</th>
        <th>Response</th>
        <th>Status Verifikasi</th>
        <th width="30%"></th>
    </thead>
    <tbody>
        @foreach ($data as $d)
            <tr>
                <td>{{ $d->tgl_kirim }}</td>
                <td>{{ $d->no_rm }}</td>
                <td>{{ $d->nama_pasien }}</td>
                <td>{{ $d->nama_unit }}</td>
                <td>{{ $d->nama_dokter }}</td>
                <td>{{ $d->file }}</td>
                <td>{{ $d->response }}</td>
                <td class="text-xs">{{ $d->status_verif}}</td>
                <td>
                    <button class="badge btn-sm btn-info lihatberkas" kodekunjungan="{{ $d->kode_kunjungan }}">Lihat
                        Berkas</button>
                    <button class="badge btn-sm btn-success verifberkas" id_table="{{ $d->id }}"
                        namapasien={{ $d->nama_pasien }}>Verif</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabeldatatte").DataTable({
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
    $(".lihatberkas").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('cetak_dokumen_tte_v2/' + kodekunjungan);
    });
    $(".verifberkas").on('click', function(event) {
        id_table = $(this).attr('id_table')
        namapasien = $(this).attr('namapasien')
        Swal.fire({
            title: "Anda Yakin ?",
            text: "Resume medis rawat jalan Pasien " + namapasien + " akan diverifikasi ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya"
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_table
                    },
                    url: '<?= route('verifikasi_berkas') ?>',
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
                            ambildata()
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                        }
                    }
                });
            }
        });
    });
</script>
