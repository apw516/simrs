<table id="tableExpertisi" class="table table-bordered table-hover table-striped w-100" style="font-size: 13px;">
    <thead class="thead-light">
        <tr>
            <th class="text-center align-middle" style="width: 40px;">No</th>
            <th class="align-middle" style="width: 200px;">Tanggal Kunjungan</th>
            <th class="align-middle">No. RM / Nama Pasien</th>
            <th class="align-middle">Nomor Sediaan</th>
            <th class="align-middle">Pemeriksaan / Tarif</th>
            <th class="align-middle">Dokter Pemeriksa</th>
            <th class="text-center align-middle" style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data as $row)
            <tr>
                <td class="text-center align-middle font-weight-bold">{{ $loop->iteration }}</td>
                <td class="align-middle">
                    {{ \Carbon\Carbon::parse($row->tgl_masuk)->format('d-m-Y H:i') }}
                </td>
                <td class="align-middle">
                    <strong>{{ $row->nama_pasien ?? '-' }}</strong><br>
                    <span class="badge badge-secondary">{{ $row->no_rm }}</span>
                    <small class="d-block text-muted text-truncate" style="max-width: 200px;"
                        title="{{ $row->alamat_pasien }}">
                        <i class="fas fa-map-marker-alt mr-1"></i>{{ $row->alamat_pasien ?? '-' }}
                    </small>
                </td>
                <td class="align-middle">
                    <span class="font-weight-bold text-primary">{{ $row->no_periksa }}</span><br>
                </td>


                <td class="align-middle">
                    <span class="font-weight-bold text-dark">{{ $row->NAMA_TARIF ?? '-' }}</span><br>
                    <small class="text-muted">Kode Tarif: {{ $row->kode_tarif_detail }}</small>
                </td>
                <td class="align-middle">
                    <i class="fas fa-user-md mr-1 text-info"></i>{{ $row->nama_dokter ?? '-' }}<br>
                    <span class="badge badge-info mt-1">{{ $row->nama_penjamin ?? '-' }}</span>
                    / @if ($row->validasi == 0)
                        <span class="badge badge-danger">Belum diisi</span>
                    @elseif ($row->validasi == 1)
                        <span class="badge badge-warning">Sudah diisi belum validasi</span>
                    @else
                        <span class="badge badge-success">Sudah divalidasi</span>
                    @endif
                </td>
                <td class="text-center align-middle">
                    <a class="btn btn-sm btn-primary pilihpasien @if ($row->kode_dokter != null) @if ($row->kode_dokter != auth()->user()->kode_paramedis) disabled @endif @endif"
                        title="Isi / Edit Expertisi" id_expertisi="{{ $row->id_Ex }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    @if ($row->validasi == 2)
                        <a href="{{ route('expertisi.cetak', ['id' => $row->id_lyheader]) }}" target="_blank" class="btn btn-sm btn-success cetakhasil" title="Print hasil expertisi ..."
                            id_expertisi="{{ $row->id_Ex }}">
                            <i class="fas fa-print"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center text-muted py-4">
                    <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                    Tidak ada data expertisi PA untuk hari ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#tableExpertisi').DataTable({
            "language": {
                "search": "Cari Pasien / Kunjungan:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            },
            "pageLength": 10,
            "order": [
                [5, "desc"]
            ] // Sort otomatis tanggal masuk
        });
        $('#tableExpertisi').on('click', '.pilihpasien', function() {
            var id_expertisi = $(this).attr('id_expertisi');
            $('.v_1').attr('hidden', true)
            $('.v_2').removeAttr('hidden', true)
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_expertisi
                },
                url: '<?= route('ambil_form_expertisi_pa') ?>',
                error: function(response) {
                    spinner.hide()
                    alert('something wrong ...')
                },
                success: function(response) {
                    spinner.hide()
                    $('.v_f').html(response);
                }
            });
        });
    });
</script>
