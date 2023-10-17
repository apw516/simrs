<table id="tbsrk" style="font-size:65%" class="table table-sm table-bordered table-hover table-stripped">
    <thead>
        <th>Nomor Kartu</th>
        <th>Nama</th>
        <th>Nomor Surat Kontrol</th>
        <th>Jenis Pelayanan</th>
        <th>Jenis Surat</th>
        <th>Tanggal Rencana Kontrol</th>
        <th>Tanggal Terbit Surat</th>
        <th>SEP asal</th>
        <th>Poli Tujuan</th>
        <th>Dokter</th>
        <th>Terpakai</th>
    </thead>
    <tbody>
        @if ($suratkontrol->metaData->code == 200)
            @foreach ($suratkontrol->response->list as $s)
                <tr class="detailsurkon" data-toggle="modal" data-target="#detailsurkon"
                    nomorsurat="{{ $s->noSuratKontrol }}" nosep="{{ $s->noSepAsalKontrol }}"
                    kodedokter="{{ $s->kodeDokter }}" namadokter="{{ $s->namaDokter }}"
                    namapoli="{{ $s->namaPoliTujuan }}" polikontrol="{{ $s->poliTujuan }}"
                    tglrencanakontrol="{{ $s->tglRencanaKontrol }}">
                    <td>{{ $s->noKartu }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->noSuratKontrol }}</td>
                    <td>{{ $s->jnsPelayanan }}</td>
                    <td>{{ $s->namaJnsKontrol }}</td>
                    <td>{{ $s->tglRencanaKontrol }}</td>
                    <td>{{ $s->tglTerbitKontrol }}</td>
                    <td>{{ $s->noSepAsalKontrol }}</td>
                    <td>{{ $s->namaPoliTujuan }}</td>
                    <td>{{ $s->namaDokter }}</td>
                    <td>{{ $s->terbitSEP }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<script>
    $(function() {
        $("#tbsrk").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "searching": true,
            "order": [
                [7, "desc"]
            ]
        })
    });
    $('#tbsrk').on('click', '.detailsurkon', function() {
        nomorsurat = $(this).attr('nomorsurat')
        nosep = $(this).attr('nosep')
        kodedokter = $(this).attr('kodedokter')
        namadokter = $(this).attr('namadokter')
        namapoli = $(this).attr('namapoli')
        polikontrol = $(this).attr('polikontrol')
        tgl = $(this).attr('tglrencanakontrol')
        $('#nomorsurat').val(nomorsurat)
        $('#tglkontrol_pasca').val(tgl)
        $('#seppasca').val(nosep)
        $('#polikontrolpasca').val(namapoli)
        $('#kodepolikontrolpasca').val(polikontrol)
        $('#dokterkontrolpasca').val(namadokter)
        $('#kodedokterkontrolpasca').val(kodedokter)
    });

    function editsurkon() {
        spinner = $('#loader');
        nomorsurat = $('#nomorsurat').val()
        nomorkartu = $('#seppasca').val()
        jenissurat = $('#jenissurat_kontrolpasca').val()
        tanggalkontrol = $('#tglkontrol_pasca').val()
        polikontrol = $('#polikontrolpasca').val()
        kodepolikontrol = $('#kodepolikontrolpasca').val()
        dokterkontrol = $('#dokterkontrolpasca').val()
        kodedokterkontrol = $('#kodedokterkontrolpasca').val()
        Swal.fire({
            title: 'Edit Surat Kontrol ?',
            text: nomorsurat,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner.show();
                $.ajax({
                    async: true,
                    dataType: 'Json',
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        nomorsurat,
                        nomorkartu,
                        jenissurat,
                        tanggalkontrol,
                        kodepolikontrol,
                        kodedokterkontrol
                    },
                    url: '<?= route('updatesuratkontrol') ?>',
                    error: function(data) {
                        spinner.hide();
                        alert('error!')
                    },
                    success: function(data) {
                        spinner.hide();
                        if (data.metaData.code == 200) {
                            Swal.fire({
                                title: 'Surat kontrol berhasil disimpan!',
                                text: "Cetak surat kontrol ? " + data.response
                                    .noSuratKontrol,
                                icon: 'success',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Cetak!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.open('cetaksurkon/' + data.response
                                        .noSuratKontrol);
                                    location.reload()
                                } else {
                                    location.reload()
                                }
                            })
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.metaData.message,
                                'error'
                            )
                        }
                    }
                });
            }
        })

    }
</script>
