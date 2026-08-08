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
                        <th class="py-3 text-center" style="width: 180px;">Aksi</th>
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
                                <!-- PERBAIKAN: Flexbox container agar tombol sejajar -->
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    <button type="button" class="btn btn-sm btn-primary shadow-sm pilihpasien"
                                        data-kodekunjungan="{{ $d->kode_kunjungan }}" data-form="1">
                                        <i class="fas fa-user-md mr-1"></i> Form 1
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-primary shadow-sm pilihpasien2"
                                        data-kodekunjungan="{{ $d->kode_kunjungan }}" data-form="2">
                                        <i class="fas fa-user-md mr-1"></i> Form 2
                                    </button>
                                </div>
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
        });

        // PERBAIKAN: Event Delegation agar tombol di halaman DataTables ke-2, ke-3, dst. tetap berfungsi
        $('#tabelkunjungan').on('click', '.pilihpasien', function() {
            var kodekunjungan = $(this).data('kodekunjungan');
            var formType = $(this).data('form'); // Jika ingin membedakan form 1 & form 2 di backend
            var spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: kodekunjungan,
                    form_type: formType
                },
                url: '<?= route('ambildetailkunjunganpasiendepo') ?>',
                error: function(response) {
                    alert('error!');
                    spinner.hide();
                },
                success: function(response) {
                    $('.v_1').attr('hidden', true);
                    $('.v_2').removeAttr('hidden');
                    $('.v_detail_pasien').html(response);
                    spinner.hide();
                }
            });
        });
        $('#tabelkunjungan').on('click', '.pilihpasien2', function() {
            var kodekunjungan = $(this).data('kodekunjungan');
            var formType = $(this).data('form'); // Jika ingin membedakan form 1 & form 2 di backend
            var spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: kodekunjungan,
                    form_type: formType
                },
                url: '<?= route('ambildetailkunjunganpasiendepo_versi2') ?>',
                error: function(response) {
                    alert('error!');
                    spinner.hide();
                },
                success: function(response) {
                    $('.v_1').attr('hidden', true);
                    $('.v_2').removeAttr('hidden');
                    $('.v_detail_pasien').html(response);
                    spinner.hide();
                }
            });
        });
    });
</script>
