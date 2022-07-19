<h5>Data Surat Kontrol Rumah Sakit Waled ...</h5>
<table id="tabelsuratkontrol_rs2" class="table table-bordered table-sm text-xs mt-3">
    <thead>
        <th>nomor kartu</th>
        <th>Nama</th>
        <th>Terbit Sep</th>
        <th>Tgl Sep</th>
        <th>Nomor surat</th>
        <th>Jn pelayanan</th>
        <th>Jn kontrol</th>
        <th>Tgl kontrol</th>
        <th>Tgl terbit</th>
        <th>SEP asal</th>
        <th>poli asal</th>
        <th>poli tujuan</th>
        <th>dokter</th>
        <th>---</th>
    </thead>
    <tbody>
        @if ($list->metaData->code == 200)
            @foreach ($list->response->list as $d)
                <tr>
                    <td>{{ $d->noKartu }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>{{ $d->terbitSEP }}</td>
                    <td>{{ $d->tglSEP }}</td>
                    <td>{{ $d->noSuratKontrol }}</td>
                    <td>{{ $d->jnsPelayanan }}</td>
                    <td>{{ $d->namaJnsKontrol }}</td>
                    <td>{{ $d->tglRencanaKontrol }}</td>
                    <td>{{ $d->tglTerbitKontrol }}</td>
                    <td>{{ $d->noSepAsalKontrol }}</td>
                    <td>{{ $d->namaPoliAsal }}</td>
                    <td>{{ $d->namaPoliTujuan }}</td>
                    <td>{{ $d->namaDokter }}</td>
                    <td>
                        <button nomorsurat="{{ $d->noSuratKontrol }}" class="badge badge-danger hapussurat"><i
                                class="bi bi-trash"></i></button>
                        <button tglkontrol="{{ $d->tglRencanaKontrol }}" jenissurat="{{ $d->jnsKontrol }}"
                            suratkontrol="{{ $d->noSuratKontrol }}" nomorsep="{{ $d->noSepAsalKontrol }}"
                            nomorkartu="{{ $d->noKartu }}" namapolitujuan="{{ $d->namaPoliTujuan }}"
                            kodepolitujuan="{{ $d->poliTujuan }}" namadokter="{{ $d->namaDokter }}"
                            kodedokter="{{ $d->kodeDokter }}" nama="{{ $d->nama }}" class="badge badge-warning editsurat"
                            data-toggle="modal" data-target="#modaleditsurkon"><i
                                class="bi bi-pencil-square"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelsuratkontrol_rs2").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $('#tabelsuratkontrol_rs2').on('click', '.hapussurat', function() {
        nomorsurat = $(this).attr('nomorsurat')
        Swal.fire({
            title: 'surat kontrol ' + nomorsurat,
            text: "Surat kontrol akan dihapus ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show()
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorsurat,
                    },
                    dataType: 'Json',
                    Async: true,
                    url: '<?= route('vclaimhapussurkon') ?>',
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
                                title: 'Berhasil dihapus ...',
                            })
                            location.reload()
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.metaData.message,
                            })
                        }
                    }
                });
            }
        });
    });
    $('#tabelsuratkontrol_rs2').on('click', '.editsurat', function() {
        tgl = $(this).attr('tglkontrol')
        jenissurat = $(this).attr('jenissurat')
        suratkontrol = $(this).attr('suratkontrol')
        nomorsep = $(this).attr('nomorsep')
        nomorkartu = $(this).attr('nomorkartu')
        namapolitujuan = $(this).attr('namapolitujuan')
        kodepolitujuan = $(this).attr('kodepolitujuan')
        namadokter = $(this).attr('namadokter')
        kodedokter = $(this).attr('kodedokter')
        nama = $(this).attr('nama')
        $('#nomorkartu_update').val(nomorkartu)
        $('#nama_update').val(nama)
        $('#nomorsuratkontrol_update').val(suratkontrol)
        $('#nomorsep_update').val(nomorsep)
        $('#tanggalkontrol_update').val(tgl)
        $('#polikontrol_update').val(namapolitujuan)
        $('#kodepolikontrol_update').val(kodepolitujuan)
        $('#dokterkontrol_update').val(namadokter)
        $('#kodedokterkontrol_update').val(kodedokter)
        $('#jenis').val(jenissurat)
    });
</script>
