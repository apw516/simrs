<div class="card mt-4">
    <div class="card-header">Data Kunjungan Pasien</div>
    <div class="card-body">
        <table class="table table-sm text-sm table-bordered table-hover" id="tabelkunjungan">
            <thead>
                <tr>
                    <th>Tanggal Masuk</th>
                    <th>Nomor SEP</th>
                    <th>Nomor RM</th>
                    <th>Nama Pasien</th>
                    <th>Nama Dokter</th>
                    <th>Unit</th>
                    <th>Status Kunjungan</th>
                    <th>Verifikasi Berkas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($d->tgl_masuk)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td><code class="text-dark">{{ $d->no_sep ?? '-' }}</code></td>
                        <td><span class="font-weight-bold">{{ $d->no_rm }}</span></td>
                        <td>{{ $d->nama_pasien }}</td>
                        <td>{{ $d->nama_dokter }}</td>
                        <td><span class="badge badge-light text-dark border">{{ $d->nama_unit }}</span></td>

                        <!-- Status Kunjungan -->
                        <td>
                            @if ($d->status_kunjungan == 1)
                                <span class="badge badge-success-soft text-success"><i class="bi bi-circle-fill mr-1"></i>
                                    Aktif</span>
                            @else
                                <span class="badge badge-secondary"><i class="bi bi-check-circle mr-1"></i>
                                    Selesai</span>
                            @endif

                            @if ($d->ref_kunjungan != 0)
                                <span class="badge badge-info ml-1" data-toggle="tooltip" title="Pasien Konsul"><i
                                        class="bi bi-person-lines-fill"></i> Konsul</span>
                            @endif
                        </td>

                        <!-- Status Verifikasi -->
                        <td>
                            @if ($d->status_verifikasi == 0)
                                <span class="badge badge-warning text-dark"><i class="bi bi-clock-history mr-1"></i>
                                    Belum Diverifikasi</span>
                            @elseif($d->status_verifikasi == 1)
                                <span class="badge badge-danger"><i class="bi bi-exclamation-triangle mr-1"></i>
                                    Pending</span>
                                @if (!empty($d->catatan_verifikasi_awal))
                                    <small class="d-block text-muted mt-1"><i class="bi bi-chat-left-text"></i>
                                        {{ $d->catatan_verifikasi_awal }}</small>
                                @endif
                            @else
                                <span class="badge badge-success"><i class="bi bi-check-all mr-1"></i>
                                    Terverifikasi</span>
                            @endif
                        </td>

                        <!-- Aksis / Tombol -->
                        <td class="text-center">
                            <button class="btn btn-sm btn-primary prosespasien shadow-sm"
                                kode="{{ $d->kode_kunjungan }}" data-toggle="tooltip" title="Proses Verifikasi">
                                <i class="bi bi-shield-check mr-1"></i> Verifikasi
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
            "ordering": false
        })
    });
    $('#tabelkunjungan').on('click', '.prosespasien', function() {
        kode_kunjungan = $(this).attr('kode')
        spinner = $('#loader')
        spinner.show();
        $.ajax({
            type: 'get',
            data: {
                _token: "{{ csrf_token() }}",
                kode_kunjungan
            },
            url: '<?= route('kunjungan.ambil-berkas-verifikasi') ?>',
            error: function(response) {
                spinner.hide();

            },
            success: function(response) {
                $('.v_1').attr('hidden', true)
                $('.v_2').removeAttr('hidden', true)
                $('.v_2').html(response);
                spinner.hide();

            }
        });
    });
</script>
