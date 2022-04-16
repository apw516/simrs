<table id="tabelriwayatpelayanan_local" class="table table-sm text-xs table-bordered">
    <thead>
        <th>nomor rm</th>
        {{-- <th>kode kunjungan</th> --}}
        <th>nama</th>
        <th>penjamin</th>
        <th>unit</th>
        {{-- <th>dokter</th> --}}
        <th>user</th>
        <th>no sep</th>
        <th>tgl masuk</th>
        <th>tgl keluar</th>
        <th>--</th>
    </thead>
    <tbody>
        @foreach ($datakunjungan as $d)
            <tr>
                <td>{{ $d->no_rm }}</td>
                {{-- <td>{{ $d->kode_kunjungan }}</td> --}}
                <td>{{ $d->nama_px }}</td>
                <td>{{ $d->nama_penjamin }}</td>
                <td>{{ $d->nama_unit }}</td>
                {{-- <td>{{ $d->nama_dokter }}</td> --}}
                {{-- <td>{{ $d->status }}</td> --}}
                <td>{{ $d->nama_user }}</td>
                <td>{{ $d->no_sep }}</td>
                <td>{{ $d->tgl_masuk }}</td>
                <td>{{ $d->tgl_keluar }}</td>
                <td>
                    <button class="badge badge-primary detailkunjungan"
                        kodekunjungan="{{ $d->kode_kunjungan }}" data-placement="right" title="detail"><i
                            class="bi bi-eye text-sm" data-toggle="modal"
                            data-target="#detailkunjungan"></i></button>
                    {{-- <button class="badge badge-danger batal" kodekunjungan="{{ $d->kode_kunjungan }}"
                        data-placement="right" title="batal periksa"><i
                            class="bi bi-trash text-sm"></i></button> --}}
                    {{-- <button class="badge badge-success pulangkan" nama="{{ $d->nama_px }}"
                        kodekunjungan2="{{ $d->kode_kunjungan }}" data-placement="right"
                        title="pulangkan pasien" data-toggle="modal" data-target="#modalpulangkanpasien"><i
                            class="bi bi-pencil-square text-sm"></i></button>
                </td> --}}
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelriwayatpelayanan_local").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 5,
            "searching": true,
            "order": [
                [6, "desc"]
            ]
        })
    });
    
    $('#tabelriwayatpelayanan_local').on('click', '.detailkunjungan', function() {
        spinner = $('#loader')
        spinner.show();
        kodekunjungan = $(this).attr('kodekunjungan')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
            },
            url: '/datakunjungan/detailkunjungan',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(response) {
                spinner.hide()
                $('.viewdetailkunjungan').html(response)
            }
        });
    });
    $('#tabelriwayatpelayanan_local').on('click', '.batal', function() {
        kodekunjungan = $(this).attr('kodekunjungan')
        Swal.fire({
            title: 'batal periksa ...',
            text: "data pendaftaran akan dibatalkan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Batal periksa',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        kodekunjungan,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '/datakunjungan/batalperiksa',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops,silahkan coba lagi',
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.metaData.code == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil dibatalkan ...',
                            })
                            location.reload()
                        }
                    }
                });
            }
        });
    });
    $('#tabelriwayatpelayanan_local').on('click', '.pulangkan', function() {
        nama = $(this).attr('nama')
        kodekunjungan = $(this).attr('kodekunjungan2')
        $('#kode_kunjungan_simrs').val(kodekunjungan)
        $('#nama_pasien').val(nama)
    })

    function gantistatuspulang2() {
        status = $('#status_pulang2').val()
        if (status == 6 || status == 7) {
            $('#formmeninggal').removeAttr('hidden', true)
        } else {
            $('#formmeninggal').attr('hidden', true)
        }
    }

    function pulangkanpasien() {
        spinner = $('#loader');
        spinner.show();            
        kodekunjungan = $('#kode_kunjungan_simrs').val()
        status = $('#status_pulang2').val()
        tanggalpulang = $('#pulang_tanggal2').val()
        tanggalmeninggal = $('#tanggal_meninggal2').val()
        suratmeninggal = $('#surat_meninggal2').val()
        nomorlp = $('#nomor_lp_manual2').val()
        if (status != 6 || status != 7 ) {
            tanggalmeninggal = ''
            suratmeninggal = ''
        }
        $.ajax({
            async: true,
            dataType: 'Json',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                status,
                tanggalpulang,
                tanggalmeninggal,
                suratmeninggal,
                nomorlp
            },
            url: '/Pendaftaran/updatepulang',
            error: function(data) {
                spinner.hide()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops,silahkan coba lagi',
                })
            },
            success: function(data) {
                spinner.hide()
                if (data.metaData.code == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pasien dipulangkan ...',
                    })
                    location.reload()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.metaData.message
                    })
                }
            }
        });
    }
</script>