<table id="tabler_konsul" class="table table-sm table-bordered table-hover">
    <thead>
        <th>Tanggal Konsul</th>
        <th>Poli Tujuan</th>
        <th>Dokter Pengirim</th>
        <th>Catatan</th>
        <th>Keterangan</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($data2 as $d)
            <tr>
                <td>{{ date('d-M-Y', strtotime($d->tgl_konsul)) }}</td>
                <td>{{ $d->nama_poli_tujuan }}</td>
                <td>{{ $d->nama_dokter_pengirim }}</td>
                <td>{{ $d->catatan }}</td>
                <td>
                    @if ($d->jenis == 'KONSUL')
                        KONSUL ANTAR POLI
                    @else
                        RUJUK POLI LAIN
                    @endif
                </td>
                <td>
                    <button class="btn btn-danger batalkonsul" idkonsul="{{ $d->id }}"><i class="bi bi-trash-fill mr-1 ml-1"></i> batal</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabler_konsul").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true
        })
    });
    $('#tabler_konsul').on('click', '.pilihriwayat', function() {
        ket = $(this).attr('ket')
        $('#keterangantindaklanjut').val(ket)

    });
    $('#tabler_konsul').on('click', '.batalkonsul', function() {

        Swal.fire({
            title: "Konsul / rujuk internal akan dibatalkan ?",
            text: "klik OK untuk lanjut ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                id = $(this).attr('idkonsul')
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id
                    },
                    url: '<?= route('batalkonsull') ?>',
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
                            $('#modalriwayatkonsul').modal('toggle');
                        }
                    }
                });
            }
        });

    });
</script>
