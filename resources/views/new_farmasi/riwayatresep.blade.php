<div class="container-fluid pt-3">
    <div class="card card-primary card-outline shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
            <h5 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-history mr-2"></i>Riwayat Resep Pasien (RM: {{ $rm ?? '-' }})
            </h5>
            <span class="badge badge-info px-3 py-2">5 Transaksi Terakhir</span>
        </div>

        <div class="card-body">
            @if ($get_kunjungan->isEmpty())
                <div class="alert alert-warning text-center my-3">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Tidak ada data riwayat resep ditemukan untuk No. RM
                    ini.
                </div>
            @else
                <div class="accordion" id="accordionRiwayat">
                    @foreach ($get_kunjungan as $index => $kunjungan)
                        @php
                            // Filter detail obat khusus untuk header resep saat ini
                            $details = $layanan_detail->where('row_id_header', $kunjungan->id);
                        @endphp
                        <div class="card border mb-3 shadow-none">
                            {{-- Header Kartu / Resep --}}
                            <div class="card-header bg-light py-2" id="heading-{{ $kunjungan->id }}">
                                <div class="row align-items-center">
                                    <div class="col-md-3 col-6">
                                        <small class="text-muted d-block">Kode Layanan / Kunjungan</small>
                                        <strong>{{ $kunjungan->kode_layanan_header ?? $kunjungan->kode_kunjungan }}</strong>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <small class="text-muted d-block">Tanggal Transaksi</small>
                                        <span>
                                            <i class="far fa-calendar-alt text-secondary mr-1"></i>
                                            {{ !empty($kunjungan->tgl_entry) ? \Carbon\Carbon::parse($kunjungan->tgl_entry)->format('d-m-Y H:i') : '-' }}
                                        </span>
                                    </div>
                                    <div class="col-md-3 col-6 mt-2 mt-md-0">
                                        <small class="text-muted d-block">Unit Asal / Penjamin</small>
                                        <span class="badge badge-secondary">{{ $kunjungan->unit_asal }} /
                                            {{ $kunjungan->nama_penjamin }}</span>
                                    </div>
                                    <div class="col-md-3 col-6 mt-2 mt-md-0 text-right">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-sm btn-outline-primary" type="button"
                                                    data-toggle="collapse" data-target="#collapse-{{ $kunjungan->id }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                                    <i class="bi bi-ticket-detailed mr-1"></i> Detail ({{ $details->count() }})
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button idresep="{{ $kunjungan->id }}" class="btn btn-sm btn-outline-primary pilihresep" type="button"
                                                    data-toggle="collapse" data-target="#collapse-{{ $kunjungan->id }}"
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                                    <i class="bi bi-check2-square mr-1"></i> Pilih Resep
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Rincian Obat (Collapse) --}}
                            <div id="collapse-{{ $kunjungan->id }}" class="collapse"
                                data-parent="#accordionRiwayat">
                                <div class="card-body p-0">
                                    <table class="table table-striped table-hover m-0 table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="5%" class="text-center">No</th>
                                                <th width="15%">Kode Obat</th>
                                                <th>Nama Obat / Barang</th>
                                                <th width="10%" class="text-center">Jumlah</th>
                                                <th width="15%" class="text-right">Harga Satuan</th>
                                                <th width="15%" class="text-right">Total Tarif</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($details as $detail)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>
                                                        <code class="text-dark">{{ $detail->kode_barang }}</code>
                                                    </td>
                                                    <td>
                                                        @if (str_starts_with($detail->kode_barang, 'R'))
                                                            <span class="badge badge-warning mr-1"><i
                                                                    class="fas fa-mortar-pestle"></i> Racikan</span>
                                                        @endif
                                                        <strong>{{ $detail->nama_barang ?? '-' }}</strong>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ number_format($detail->jumlah_layanan ?? ($detail->jumlah ?? 0), 0, ',', '.') }}
                                                    </td>
                                                    <td class="text-right">
                                                        Rp
                                                        {{ number_format($detail->tarif_layanan ?? 0, 0, ',', '.') }}
                                                    </td>
                                                    <td class="text-right font-weight-bold">
                                                        Rp
                                                        {{ number_format(($detail->tarif_layanan ?? 0) * ($detail->jumlah_layanan ?? ($detail->jumlah ?? 1)), 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-3">
                                                        <em>Tidak ada detail obat/barang pada resep ini.</em>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    $(".pilihresep").on('click', function(event) {
        idresep = $(this).attr('idresep')
        spinner_on()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idresep
            },
            url: '<?= route('ambildetailresepbaru') ?>',
            error: function(response) {
                spinner_off()
                alert('error')
            },
            success: function(response) {
                spinner_off()
                $('#wrapper-obat-terpilih').append(response.html);
                $('#empty-row').hide();
                updateNomorUrut();
                checkSubmitButton();
            }
        });
    })
     $('#wrapper-obat-terpilih').on("click", ".remove_field", function(e) {
        e.preventDefault();
        $(this).closest('.row').remove();
    });
    function updateNomorUrut() {
        $('#wrapper-obat-terpilih tr').not('#empty-row').each(function(index) {
            $(this).find('.nomor-urut').text(index + 1);
        });
    }
    function checkSubmitButton() {
        var totalItem = $('#wrapper-obat-terpilih tr').not('#empty-row').length;
        if (totalItem > 0) {
            $('#btn-submit-obat').prop('disabled', false);
        } else {
            $('#btn-submit-obat').prop('disabled', true);
        }
    }

</script>
