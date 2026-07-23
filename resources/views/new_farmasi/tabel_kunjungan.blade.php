<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="tabelkunjungan" class="table table-hover align-middle mb-0">
                <thead class="bg-light text-uppercase text-secondary fs-7 font-weight-bold">
                    <tr>
                        <th class="py-3 px-3">Tanggal</th>
                        <th class="py-3">No. RM</th>
                        <th class="py-3">Pasien</th>
                        <th class="py-3">JK / Tgl Lahir</th>
                        <th class="py-3">Alamat</th>
                        <th class="py-3">Poliklinik / Ruangan</th>
                        <th class="py-3">Dokter</th>
                        <th class="py-3">Penjamin</th>
                        <th class="py-3 text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($kunjungan as $d)
                        <tr>
                            <td class="px-3">
                                <span class="fw-bold text-dark d-block">
                                    {{ \Carbon\Carbon::parse($d->tgl_masuk)->translatedFormat('d/m/Y') }}
                                </span>
                                <small class="text-muted">
                                    {{ \Carbon\Carbon::parse($d->tgl_masuk)->format('H:i') }} WIB
                                </small>
                            </td>
                            <td>
                                <code class="bg-light px-2 py-1 rounded border text-primary fw-bold">
                                    {{ $d->no_rm }}
                                </code>
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block">{{ $d->nama_pasien }}</span>
                            </td>
                            <td>
                                <span
                                    class="badge {{ $d->jenis_kelamin == 'L' ? 'bg-info text-dark' : 'bg-danger' }} mb-1">
                                    {{ $d->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                                <small class="text-muted d-block">
                                    {{ \Carbon\Carbon::parse($d->tgl_lahir)->translatedFormat('d M Y') }}
                                </small>
                            </td>
                            <td>
                                <small class="text-secondary text-truncate d-inline-block" style="max-width: 180px;"
                                    title="{{ $d->alamat }}">
                                    {{ $d->alamat ?? '-' }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-clinic-medical mr-1 text-primary"></i> {{ $d->nama_unit }}
                                </span>
                            </td>
                            <td>
                                <small class="fw-bold text-dark d-block">dr. {{ $d->nama_dokter }}</small>
                            </td>
                            <td>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success">
                                    {{ $d->nama_penjamin }}
                                </span>
                            </td>
                            <td class="text-center px-3">
                                <a class="btn btn-sm btn-primary shadow-sm btn-block pilihpasien"
                                    data-kodekunjungan={{ $d->kode_kunjungan }}>
                                    <i class="fas fa-user-md mr-1"></i> Layani
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-inbox fa-2x mb-2 d-block opacity-50"></i>
                                Tidak ada data kunjungan pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#tabelkunjungan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $('.pilihpasien').on('click', function() {
        kodekunjungan = $(this).attr('data-kodekunjungan')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan
            },
            url: '<?= route('ambildetailkunjunganpasiendepo') ?>',
            error: function(response) {
                alert('error!')
                spinner.hide()
            },
            success: function(response) {
                $('.v_1').attr('hidden',true)
                $('.v_2').removeAttr('hidden',true)
                $('.v_detail_pasien').html(response);
                spinner.hide()
            }
        });
    });
</script>
