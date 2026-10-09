<div class="card">
    <div class="card-header">Profil Ringkas Medis Rawat Jalan</div>
    <div class="card-body">
        @if (count($riwayat2) > 0)
            <div class="alert alert-success border-0 shadow-sm d-flex justify-content-between align-items-center p-3 mb-3 rounded-3"
                style="background-color: #f0fdf4; border-left: 5px solid #198754 !important;">
                <div class="d-flex align-items-center">
                    <div class="mr-3 me-3 text-success align-self-start mt-1">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 font-weight-bold fw-bold text-success">Status Pasien PRMJ</h6>
                        <p class="text-muted small mb-2">
                            Pasien terdeteksi memenuhi kriteria <strong>Pasien PRMJ</strong> berdasarkan riwayat
                            diagnosa 3 bulan terakhir.
                        </p>
                        <table class="table table-sm text-dark">
                            <thead>
                                <th>Tanggal</th>
                                <th>Diag utama</th>
                                <th>Diag Sekunder</th>
                            </thead>
                            <tbody>
                                @foreach ($riwayat2 as $r)
                                    <tr>
                                        <td>{{ $r->input_date }}</td>
                                        <td>{{ $r->diag_utama }}</td>
                                        <td>{{ $r->diag_sekunder_01 }}, {{ $r->diag_sekunder_02 }},
                                            {{ $r->diag_sekunder_03 }}, {{ $r->diag_sekunder_04 }},
                                            {{ $r->diag_sekunder_05 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
        <table class="table table-sm table-bordered mt-2">
            <thead>
                <th>Tanggal / Jam</th>
                <th>DPJP</th>
                <th>Diagnosa Penting</th>
                <th>Uraian Klinis Penting</th>
                <th>Rencana Penting</th>
                <th>Remarks / Catatan Penting</th>
            </thead>
            <tbody>
                @foreach ($assesmenMedis as $r)
                    <tr>
                        <td>{{ $r->tgl_entry }}</td>
                        <td>{{ $r->nama_dokter }}</td>
                        <td>{{ $r->diagnosakerja }} <br><br>
                            @foreach ($riwayat2 as $rr)
                                @if ($rr->kode_kunjungan == $r->id_kunjungan)
                                    Koding diagnosa Utama : {{ $rr->diag_utama }} <br>
                                    Koding diagnosa Sekunder : {{ $rr->diag_sekunder_01 }}, {{ $rr->diag_sekunder_02 }},
                                    {{ $rr->diag_sekunder_03 }}, {{ $rr->diag_sekunder_04 }},
                                    {{ $rr->diag_sekunder_05 }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $r->keluhan_pasien }} <br>
                        {{ $r->keterangan_alergi }} <br>
                        {{ $r->riwyat_penyakit_sekarang }}
                        </td>
                        <td>{{ $r->tindakanmedis }} <br>
                            {{ $r->rencanakerja }} <br>
                            {{ $r->tindak_lanjut }} <br>
                            {{ $r->catatan_operasi }} <br>
                        </td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function simpandata() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formisian').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaanprmj') ?>',
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
                    $('#modalprmj').modal('hide');
                    formprmj()
                }
            }
        });
    }

    function simpandataedit() {
        spinner = $('#loader')
        spinner.show();
        var data = $('.formisianedit').serializeArray();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                data: JSON.stringify(data),
            },
            url: '<?= route('simpanpemeriksaanprmjedit') ?>',
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
                    $('#modaleditprmj').modal('hide');
                    formprmj()
                }
            }
        });
    }
    $('.hapusdata').click(function() {
        id = $(this).attr('iddokumen')
        Swal.fire({
            title: "Data ringkasan akan dihapus ?",
            text: "Klik ok untuk hapus data ...",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                hapusdata(id)
            }
        });
    });
    $('.editdata').click(function() {
        iddokumen = $(this).attr('iddokumen')
        kode_kunjungan = $(this).attr('kode_kunjungan')
        rm = $(this).attr('nomor_rm')
        kode_paramedis = $(this).attr('kode_paramedis')
        nama_dokter = $(this).attr('namadokter')
        diagnosis = $(this).attr('diagnosis')
        uraian = $(this).attr('uraian')
        rencana = $(this).attr('rencana')
        catatan = $(this).attr('catatan')
        $('#id_dokumen_edit').val(iddokumen)
        $('#diagnosapenting_edit').val(diagnosis)
        $('#kode_kunjungan_edit').val(kode_kunjungan)
        $('#nomor_rm_edit').val(rm)
        $('#uraianklinispenting_edit').val(uraian)
        $('#rencanapenting_edit').val(rencana)
        $('#catatanpenting_edit').val(catatan)
    });

    function hapusdata(id) {
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                id,
            },
            url: '<?= route('hapusdataprmj') ?>',
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
                    formprmj()
                }
            }
        });
    }
</script>
