@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Depo Obat</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Depo Obat</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="v_1">
                @if (auth()->user()->unit != '4008')
                    <div id="realtime-alert-container"></div>
                @endif
                <div class="card card-outline card-primary shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-filter mr-1"></i> Filter Data Kunjungan / Pelayanan
                        </h3>
                    </div>
                    <form action="" method="GET" id="form-filter">
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Awal -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="tgl_awal" class="form-label font-weight-bold">Tanggal Awal</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal"
                                            value="{{ request('tgl_awal', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <!-- Tanggal Akhir -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="tgl_akhir" class="form-label font-weight-bold">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                            value="{{ request('tgl_akhir', date('Y-m-d')) }}" required>
                                    </div>
                                </div>
                                <!-- Pilihan Jenis Pelayanan / Unit -->
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="jenis_pelayanan" class="form-label font-weight-bold">Jenis Pelayanan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-hospital-user"></i></span>
                                        </div>
                                        <select class="form-control" id="jenis_pelayanan" name="jenis_pelayanan">
                                            <option value="all"
                                                {{ request('jenis_pelayanan') == 'all' ? 'selected' : '' }}>
                                                -- Semua Pelayanan --</option>
                                            <option value="J"
                                                {{ request('jenis_pelayanan') == 'J' ? 'selected' : '' }}>
                                                Rawat Jalan
                                            </option>
                                            <option value="I"
                                                {{ request('jenis_pelayanan') == 'I' ? 'selected' : '' }}>
                                                Rawat Inap
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="card-footer bg-white text-right">
                            <button type="reset" class="btn btn-secondary mr-2" onclick="location.reload()">
                                <i class="fas fa-undo mr-1"></i> Reset
                            </button>
                            <button type="button" class="btn btn-primary" onclick="tampilkandata()">
                                <i class="fas fa-search mr-1"></i> Tampilkan Data
                            </button>
                        </div>
                    </form>
                    <div class="v_data_pasien mt-2">
                        <div class="card">
                            <div class="card-header">Data Kunjungan Pasien</div>
                            <div class="card-body">
                                <div class="vd">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="v_2">
                <button class="btn btn-danger" onclick="kembali()"><i class="bi bi-backspace"></i> Kembali</button>
                <div class="v_detail_pasien mt-2">

                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            tampilkandata()
        });

        function tampilkandata() {
            tgl_awal = $('#tgl_awal').val()
            tgl_akhir = $('#tgl_akhir').val()
            jenis_pelayanan = $('#jenis_pelayanan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tgl_awal,
                    tgl_akhir,
                    jenis_pelayanan
                },
                url: '<?= route('ambildatakunjungandepo') ?>',
                error: function(response) {
                    alert('error!')
                    spinner.hide()
                },
                success: function(response) {
                    $('.vd').html(response);
                    spinner.hide()
                }
            });
        }

        function kembali() {
            $('.v_1').removeAttr('hidden', true)
            $('.v_2').attr('hidden', true)
        }

        function caripasien_far() {
            rm = $('#cari_rm').val()
            tanggalcari = $('#tanggalcari').val()
            poliklinik = $('#poliklinik').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm,
                    poliklinik,
                    tanggalcari
                },
                url: '<?= route('ambil_data_pasien_far') ?>',
                success: function(response) {
                    $('.v_t_pasien_poli').html(response);
                    spinner.hide()
                }
            });
        }
    </script>
    <script>
        // Variabel global untuk menyimpan jumlah orderan sebelumnya
        let lastOrderCount = 0;

        $(document).ready(function() {
            checkRealtimeNotification();
            // Cek ulang setiap 10 detik
            setInterval(checkRealtimeNotification, 10000);
        });

        // Fungsi untuk memainkan suara notifikasi
        function playNotificationSound() {
            // Ganti URL ini dengan file audio lokal Anda jika ada, misal: new Audio('/sounds/notification.mp3')
            // let sound = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
            let sound = new Audio('https://assets.mixkit.co/active_storage/sfx/2019/2019-preview.mp3');
            sound.play().catch(function(error) {
                // Mencegah error jika browser memblokir Autoplay sebelum pengguna melakukan interaksi (klik) di halaman
                console.warn(
                    "Autoplay diblokir oleh browser. Pengguna harus berinteraksi dengan halaman terlebih dahulu.",
                    error);
            });
        }

        function checkRealtimeNotification() {
            $.ajax({
                url: "{{ route('farmasi.check-notif') }}",
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    if (response.status && response.total_baru > 0) {

                        // BUNYIKAN SUARA HANYA JIKA ADA PENAMBAHAN ORDER BARU
                        if (response.total_baru != lastOrderCount) {
                            playNotificationSound();
                        }

                        // Update data pembanding dengan total orderan terbaru
                        lastOrderCount = response.total_baru;

                        let rows = '';
                        // Looping data list order
                        $.each(response.data, function(index, item) {
                            let jam = item.tgl_entry ? item.tgl_entry.split(' ')[1] : '-';
                            rows += `
                    <tr>
                        <td class="text-center">${item.kode_order ?? '-'}</td>
                        <td class="text-center">${jam}</td>
                        <td class="text-center">${item.no_rm ?? '-'}</td>
                        <td>${item.nama_px ?? '-'}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-primary shadow-sm pilihpasien2"
                                data-kodekunjungan="${item.kode_kunjungan}" data-form="2">
                                <i class="fas fa-user-md mr-1"></i> Terima
                            </button>
                        </td>
                    </tr>
                `;
                        });

                        let alertHtml = `
                <div class="card card-warning card-outline shadow-sm mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title font-weight-bold text-warning-emphasis">
                            <i class="fas fa-bell fa-bounce mr-1"></i> 
                            Ada <span class="badge badge-danger">${response.total_baru}</span> Order Farmasi Baru Hari Ini
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-sm btn-primary mr-1" onclick="tampilkandata()">
                                <i class="fas fa-sync-alt mr-1"></i> Refresh Utama
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table id="tabelorder" class="table table-striped table-bordered table-sm mb-0" style="font-size: 13px; width:100%;">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center">Kode Order</th>
                                        <th class="text-center">Jam</th>
                                        <th class="text-center">No. RM</th>
                                        <th>Nama Pasien</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rows}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    ${response.total_baru > 5 ? `
                            <div class="card-footer p-1 text-center bg-light">
                                <small class="text-muted">* Menampilkan ${response.total_baru} orderan terbaru.</small>
                            </div>
                        ` : ''}
                </div>
            `;

                        // 1. Hancurkan instance DataTable terdahulu jika sudah ada
                        if ($.fn.DataTable.isDataTable('#tabelorder')) {
                            $('#tabelorder').DataTable().destroy();
                        }

                        // 2. Render HTML baru ke container
                        $('#realtime-alert-container').html(alertHtml);

                        // 3. Inisialisasi DataTables SETELAH HTML terpasang
                        $('#tabelorder').DataTable({
                            "responsive": true,
                            "lengthChange": false,
                            "autoWidth": false,
                            "pageLength": 5,
                            "searching": true,
                            "ordering": false,
                            "language": {
                                "search": "Cari Order:",
                                "zeroRecords": "Tidak ada orderan ditemukan",
                                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ order",
                                "infoEmpty": "Menampilkan 0 order",
                                "paginate": {
                                    "next": ">>",
                                    "previous": "<<"
                                }
                            }
                        });

                        // Memastikan event handler dipasang dengan benar (menggunakan .off() agar tidak double binding)
                        $('#tabelorder').off('click', '.pilihpasien2').on('click', '.pilihpasien2', function() {
                            var kodekunjungan = $(this).data('kodekunjungan');
                            var formType = $(this).data('form');
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

                    } else {
                        // Reset counter jika orderan sudah habis
                        lastOrderCount = 0;

                        // Hancurkan DataTable jika data kosong/habis
                        if ($.fn.DataTable.isDataTable('#tabelorder')) {
                            $('#tabelorder').DataTable().destroy();
                        }
                        $('#realtime-alert-container').empty();
                    }
                },
                error: function(err) {
                    console.error("Gagal mengambil notifikasi order:", err);
                }
            });
        }
    </script>
@endsection
