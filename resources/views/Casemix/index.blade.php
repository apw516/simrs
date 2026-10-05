@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Verifikasi Berkas Pasien Rawat Jalan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Verifikasi Berkas Pasien Rawat Jalan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="v_1">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">Tentukan Range Tanggal</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="tanggalawal" value="{{ $now }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="tanggalakhir" value="{{ $now }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Jenis Kunjungan</label>
                                    <select style="pointer-events: none;" class="form-control" id="jeniskunjungan">
                                        <option value="1" selected>Rawat Jalan</option>
                                        <option value="2">Rawat Inap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Pilih Unit</label>
                                    <select class="form-control" id="unit">
                                        <option value="1">SEMUA</option>
                                        @foreach ($unit as $u)
                                            <option value="{{ $u->kode_unit }}">{{ $u->nama_unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" style="margin-top:32px" onclick="caridatakunjungan()"><i
                                        class="bi bi-search mr-1 ml-1"></i> Tampilkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="v_data">
    
                    </div>
                </div>
            </div>
        </div>
        <div hidden class="v_2">
        </div>
    </section>
    <script>
        $(document).ready(function() {
            caridatakunjungan()
        });
        function caridatakunjungan() {
            // Ambil nilai dari filter input
            var tanggalawal = $('#tanggalawal').val();
            var tanggalakhir = $('#tanggalakhir').val();
            var jeniskunjungan = $('#jeniskunjungan').val();
            var unit = $('#unit').val();
    
            // Tampilkan indikator loading saat proses berlangsung
            $('.v_data').html(`
                <div class="text-center my-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Mengambil data kunjungan...</p>
                </div>
            `);
    
            // Kirim permintaan AJAX
            $.ajax({
                url: "{{ route('kunjungan.get-data') }}", // Ganti dengan nama route atau URL controller Anda
                type: "GET",
                data: {
                    tanggalawal: tanggalawal,
                    tanggalakhir: tanggalakhir,
                    jeniskunjungan: jeniskunjungan,
                    unit: unit
                },
                success: function(response) {
                    // Tampilkan hasil (HTML partial dari Controller) ke v_data
                    $('.v_data').html(response);
                },
                error: function(xhr, status, error) {
                    // Penanganan jika terjadi eror
                    $('.v_data').html(`
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill mr-2"></i>
                        Gagal mengambil data: ${xhr.responseText || error}
                    </div>
                `);
                }
            });
        }
         $('.select2-autocomplete').select2({
            theme: 'bootstrap4',
            tags: true, // Memungkinkan user mengetik pilihan baru jika tidak ada di list
            tokenSeparators: [',', '\n'],
            width: '100%',
            ajax: {
                url: '/api/get-diagnosa',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { q: params.term };
                },
                processResults: function (data) {
                    return { results: data };
                },
                cache: true
            } 
            /* 
            // Jika mengambil data autocomplete secara asynchronous dari Server/API (ICD-10 / ICD-9):
            */
        });
    </script>
@endsection
