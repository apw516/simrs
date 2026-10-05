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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $d->tgl_masuk }}</td>
                        <td>{{ $d->no_sep }}</td>
                        <td>{{ $d->no_rm }}</td>
                        <td>{{ $d->nama_pasien }}</td>
                        <td>{{ $d->nama_dokter }}</td>
                        <td>{{ $d->nama_unit }}</td>
                        <td>
                            @if ($d->status_kunjungan == 1)
                                <span class="badge badge-success">aktif</span>
                            @else
                                <span class="badge badge-secondary">selesai</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-success prosespasien" data-kode="{{ $d->kode_kunjungan }}"
                                title="Proses Verifikasi">
                                <i class="bi bi-box-arrow-in-right"></i>
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
        // Inisialisasi DataTables
        var table = $("#tabelkunjungan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "order": false
        });
        $('.prosespasien').on('click', function() {
            var kode_kunjungan = $(this).data('kode');
            // Tampilkan loader di .v_2
            spinner = $('#loader')
            spinner.show();
            $('.v_2').html(`
                <div class="text-center my-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat Form Verifikasi...</p>
                </div>
            `);

            // Sembunyikan kontainer v_1 dan tampilkan kontainer v_2
            // $('.v_1').addClass(
            //     'd-none'); // atau $('.v_1').hide();$('.v_2').removeClass('d-none').show();

            // Request AJAX untuk mengambil form verifikasi
            $.ajax({
                url: "{{ route('kunjungan.ambil-form-verifikasi') }}", // Sesuaikan dengan nama route Anda
                type: "GET",
                data: {
                    kode_kunjungan: kode_kunjungan
                },
                success: function(response) {
                    $('.v_1').hide()
                    $('.v_2').removeAttr('hidden', true)
                    $('.v_2').html(response);
                    spinner.hide();
                    $('.select2-diagnosa').select2({
                        theme: 'bootstrap4',
                        placeholder: 'Pilih atau ketik...',
                        allowClear: true,
                        tags: true
                    });
                    //  $('.v_2').html(response.html);
                },
                error: function(xhr, status, error) {
                    spinner.hide();
                    $('.v_2').html(`
                        <div class="alert alert-danger" role="alert">
                            Gagal memuat form verifikasi: ${xhr.responseText || error}
                            <br>
                            <button class="btn btn-sm btn-secondary mt-2" onclick="kembaliKeTabel()">Kembali</button>
                        </div>
                    `);
                }
            });
        })
        // Event listener saat tombol prosespasien diklik

    });

    // Fungsi tambahan untuk kembali ke tampilan v_1 jika dibutuhkan
    function kembaliKeTabel() {
        $('.v_2').addClass('d-none').hide().empty();
        $('.v_1').removeClass('d-none').show();
    }
</script>
