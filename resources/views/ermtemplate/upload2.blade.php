<div class="card">
    <div class="card-header bg-warning">Upload Berkas dari luar / berkas penunjang Lain</div>
    <div class="card-body">
        <input hidden id="kodekunjungan" type="text" value="{{ $kodekunjungan }}">
        <!-- Wrapper untuk menampung form upload dinamis -->
        <div id="dynamic-upload-container">
            <div class="row upload-item mb-3">
                <div class="col-md-3 mb-2">
                    <select class="form-control jenis-file" name="jenis_file[]">
                        <option value="" disabled selected>-- Pilih Jenis Berkas --</option>
                        <option value="lab_luar">Berkas Laboratorium dari Luar</option>
                        <option value="rad_luar">Berkas Radiologi dari Luar</option>
                        <option value="echo_jantung">Echo Jantung</option>
                        <option value="ekg">EKG</option>
                        <option value="endoskopi">Endoskopi</option>
                        <option value="produk_obat">Produk Obat</option>
                        <option value="laporan_polisi">Laporan Polisi</option>
                        <option value="kronologis_laka">Kronologis Laka</option>
                        <option value="kronologis_laka">USG Poliklinik</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" class="form-control nama-file" name="namafile[]"
                        placeholder="Masukan nama file ...">
                </div>
                <div class="col-md-4 mb-2">
                    <input type="file" class="form-control file-upload" name="fileupload[]">
                </div>
                <div class="col-md-1 mb-2">
                    <button type="button" class="btn btn-danger btn-block btn-remove" style="display: none;">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>

        <!-- Hidden input untuk kode unit -->
        <input hidden type="text" id="kodeunitnya" value="{{ auth()->user()->unit }}">

        <!-- Tombol Aksi -->
        <div class="row mb-4">
            <div class="col-md-12">
                <button type="button" class="btn btn-secondary" id="btn-add-more">
                    <i class="fas fa-plus"></i> Tambah Form Upload
                </button>
                <button class="btn btn-primary" type="button" id="btn-submit" onclick="uploadFile()">
                    Simpan Semua Berkas
                </button>
            </div>
        </div>

        <!-- Section Riwayat Upload -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info text-white">Riwayat Upload</div>
                    <div class="card-body">
                        <div class="riwayatupload">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script jQuery untuk kontrol form dinamis & AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tambah baris form baru
        $('#btn-add-more').click(function() {
            let newItem = $('.upload-item:first').clone();

            // Reset nilai input pada baris baru
            newItem.find('input').val('');
            newItem.find('select').val('');

            // Tampilkan tombol hapus untuk baris tambahan
            newItem.find('.btn-remove').show();

            $('#dynamic-upload-container').append(newItem);
        });
        riwayatupload()
        // Hapus baris form
        $(document).on('click', '.btn-remove', function() {
            $(this).closest('.upload-item').remove();
        });
    });
    // Fungsi untuk menangani proses upload via AJAX (FormData)
    function uploadFile() {
        let spinner = $('#loader');
        let fd = new FormData();
        let isValid = true;

        // Ambil data pendukung
        let kodekunjungan = $('#kodekunjungan').val();
        let nomorrm = $('#nomorrm').val();
        let kodeunitnya = $('#kodeunitnya').val();

        // Loop setiap baris form dinamis
        $('.upload-item').each(function(index) {
            let jenis = $(this).find('.jenis-file').val();
            let nama = $(this).find('.nama-file').val();
            let file = $(this).find('.file-upload')[0].files[0];

            // Validasi kelengkapan di tiap baris
            if (!jenis || !nama || !file) {
                isValid = false;
                return false; // Hentikan loop
            }

            // Masukkan data berkas berseri ke FormData
            fd.append(`upload_data[${index}][jenis]`, jenis);
            fd.append(`upload_data[${index}][nama]`, nama);
            fd.append(`upload_data[${index}][file]`, file);
        });

        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Form Belum Lengkap',
                text: 'Harap isi jenis berkas, nama file, dan pilih file pada semua baris yang ada!'
            });
            return;
        }

        // Tambahkan token dan meta data pasien ke FormData
        fd.append('_token', "{{ csrf_token() }}");
        fd.append('kodekunjungan', kodekunjungan);
        fd.append('nomorrm', nomorrm);
        fd.append('kodeunitnya', kodeunitnya);

        // Tampilkan loader sebelum request
        spinner.show();

        $.ajax({
            async: true,
            type: 'POST',
            dataType: 'json',
            contentType: false,
            processData: false,
            data: fd,
            url: "<?= route('uploadgambarnyabaru') ?>",
            success: function(data) {
                spinner.hide();

                if (data.kode == 500) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: data.message
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message
                    });

                    // Reset form dinamis ke kondisi awal (1 baris kosong)
                    $('#dynamic-upload-container').html(`
                    <div class="row upload-item mb-3">
                        <div class="col-md-3 mb-2">
                            <select class="form-control jenis-file" name="jenis_file[]">
                                <option value="" disabled selected>-- Pilih Jenis Berkas --</option>
                                <option value="lab_luar">Berkas Lab Luar</option>
                                <option value="rad_luar">Rad Luar</option>
                                <option value="echo_jantung">Echo Jantung</option>
                                <option value="ekg">EKG</option>
                                <option value="endoskopi">Endoskopi</option>
                                <option value="produk_obat">Produk Obat</option>
                                <option value="laporan_polisi">Laporan Polisi</option>
                                <option value="kronologis_laka">Kronologis Laka</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" class="form-control nama-file" name="namafile[]" placeholder="Masukan nama file ...">
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="file" class="form-control file-upload" name="fileupload[]">
                        </div>
                        <div class="col-md-1 mb-2">
                            <button type="button" class="btn btn-danger btn-block btn-remove" style="display: none;">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                `);

                    // Reload riwayat upload
                    if (typeof riwayatupload === 'function') {
                        riwayatupload(kodekunjungan);
                    }
                }
            },
            error: function(xhr) {
                spinner.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops....',
                    text: 'Sepertinya ada masalah koneksi atau server...'
                });
            }
        });
    }

    function riwayatupload() {
        $kodekunjungan = $('#kodekunjungan').val()
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                kodekunjungan,
                rm
            },
            url: '<?= route('riwayatupload') ?>',
            success: function(response) {
                $('.riwayatupload').html(response);
            }
        });
    }
</script>
