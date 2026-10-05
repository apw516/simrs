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
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($riwayat as $r)
                    <tr>
                        <td>{{ $r->tgl_entry }}</td>
                        <td>{{ $r->nama_dokter }}</td>
                        <td>{{ $r->diagnosis }}</td>
                        <td>{{ $r->uraian }}</td>
                        <td>{{ $r->rencana }}</td>
                        <td>{{ $r->catatan }}</td>
                        <td>
                            <button @if ($r->pic != auth()->user()->id) disabled @endif
                                class="btn btn-danger btn-sm hapusdata" iddokumen="{{ $r->id }}"><i
                                    class="bi bi-trash3"></i></button>
                            <button @if ($r->pic != auth()->user()->id) disabled @endif
                                class="btn btn-warning btn-sm editdata" iddokumen="{{ $r->id }}"
                                kode_kunjungan="{{ $r->kode_kunjungan }}" nomor_rm="{{ $r->nomor_rm }}"
                                kode_paramedis="{{ $r->kode_paramedis }}" namadokter="{{ $r->nama_dokter }}"
                                diagnosis="{{ $r->diagnosis }}" uraian="{{ $r->uraian }}"
                                rencana="{{ $r->rencana }}" catatan="{{ $r->catatan }}" data-toggle="modal"
                                data-target="#modaleditprmj"><i class="bi bi-pencil-square"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalprmj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Profil Ringkas Medis Rawat Jalan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formisian">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diagnosa Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="diagnosapenting" name="diagnosapenting"
                            aria-describedby="emailHelp" placeholder="Masukan diagnosa penting ...">
@if ($cek)
{{ $cek->diagnosis }}
@endif
</textarea>
                        <input hidden rows="3" type="email" class="form-control" id="kode_kunjungan"
                            name="kode_kunjungan" aria-describedby="emailHelp"
                            placeholder="Masukan diagnosa penting ..." value="{{ $kode_kunjungan }}"></input>
                        <input hidden rows="3" type="email" class="form-control" id="nomor_rm" name="nomor_rm"
                            aria-describedby="emailHelp" placeholder="Masukan diagnosa penting ..."
                            value="{{ $no_rm }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Uraian Klinis Penting</label>
                        <textarea rows="3" type="email" class="form-control" name="uraianklinispenting" id="uraianklinispenting"
                            aria-describedby="emailHelp" placeholder="Masukan Uraian klinis penting ...">
@if ($cek)
{{ $cek->uraian }}
@endif
</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rencana Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="rencanapenting" name="rencanapenting"
                            aria-describedby="emailHelp" placeholder="Masukan rencana penting ...">
@if ($cek)
{{ $cek->rencana }}
@endif
</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks / Catatan Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="catatanpenting" name="catatanpenting"
                            aria-describedby="emailHelp" placeholder="Masukan Remarks / Catatan Penting ...">
@if ($cek)
{{ $cek->catatan }}
@endif
</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpandata()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modaleditprmj" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Form Edit Profil Ringkas Medis Rawat Jalan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="formisianedit">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Diagnosa Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="diagnosapenting_edit" name="diagnosapenting_edit"
                            aria-describedby="emailHelp" placeholder="Masukan diagnosa penting ..."></textarea>
                        <input hidden rows="3" type="email" class="form-control" id="kode_kunjungan_edit"
                            name="kode_kunjungan_edit" aria-describedby="emailHelp"
                            placeholder="Masukan diagnosa penting ..." value=""></input>
                        <input hidden rows="3" type="email" class="form-control" id="nomor_rm_edit"
                            name="nomor_rm_edit" aria-describedby="emailHelp"
                            placeholder="Masukan diagnosa penting ..." value=""></input>
                        <input hidden rows="3" type="email" class="form-control" id="id_dokumen_edit"
                            name="id_dokumen_edit" aria-describedby="emailHelp"
                            placeholder="Masukan diagnosa penting ..." value=""></input>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Uraian Klinis Penting</label>
                        <textarea rows="3" type="email" class="form-control" name="uraianklinispenting_edit"
                            id="uraianklinispenting_edit" aria-describedby="emailHelp" placeholder="Masukan Uraian klinis penting ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rencana Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="rencanapenting_edit" name="rencanapenting_edit"
                            aria-describedby="emailHelp" placeholder="Masukan rencana penting ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Remarks / Catatan Penting</label>
                        <textarea rows="3" type="email" class="form-control" id="catatanpenting_edit" name="catatanpenting_edit"
                            aria-describedby="emailHelp" placeholder="Masukan Remarks / Catatan Penting ..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpandataedit()">Simpan</button>
            </div>
        </div>
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
