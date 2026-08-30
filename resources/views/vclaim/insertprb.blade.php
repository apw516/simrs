@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Insert PRB</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route}}">Dashboard</a></li> --}}
                        {{-- <li class="breadcrumb-item active">Pendaftaran</li> --}}
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
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Nomor SEP</div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Ketik Nomor sep ..."
                                        id="sep_prb">
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Nomor Kartu</div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Ketik Nomor kartu ..."
                                        id="noka_prb">
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Email</div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="email peserta ..."
                                        id="email_prb">
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Program PRB</div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input readonly type="text" class="form-control"
                                            placeholder="Pilih program PRB..." aria-label="Recipient's username"
                                            id="programprb" aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success" data-toggle="modal"
                                                data-target="#modalprogramprb" type="button"><i
                                                    class="bi bi-plus text-md"></i></button>
                                            <input hidden type="text" class="form-control"
                                                placeholder="Ketik Nomor kartu ..." id="kodeprogramprb">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Dokter</div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Pilih dokter  ..."
                                        id="dokter_prb">
                                    <input hidden type="text" class="form-control" placeholder="Pilih dokter  ..."
                                        id="kodedokter_prb">
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Alamat</div>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" placeholder="Alamat pasien ..." id="alamatpx_prb"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Keterangan</div>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" placeholder="keterangan ..." id="keterangan_prb"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Saran</div>
                                <div class="col-sm-8">
                                    <textarea type="text" class="form-control" placeholder="saran ..." id="saran_prb"></textarea>
                                </div>
                            </div>
                            <div hidden class="row mt-2 dokterlayan">
                                <div class="col-sm-4 text-right text-bold">Total Jenis Obat</div>
                                <div class="col-sm-8">
                                    {{-- <input type="text" class="form-control"> --}}
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Total jenis obat ..."
                                            aria-label="Recipient's username" id="jlhjns_obat"
                                            aria-describedby="button-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-success" type="button"
                                                onclick="add_jenisobat()"><i class="bi bi-plus text-md"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-rujukan-khusus">
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" id="search-input" class="form-control"
                                        placeholder="Pencarian nama obat ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-success" type="button" id="btn-search-obat">
                                            <i class="fas fa-search mr-1"></i> Cari Obat
                                        </button>
                                    </div>
                                </div>
                                <div id="container-hasil-pencarian" class="card shadow-sm mb-4 style-hidden"
                                    style="display: none;">
                                    <div class="card-header bg-light py-2">
                                        <small class="font-weight-bold text-muted">Hasil Pencarian Obat</small>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                                            <table id="tabelpencarian"
                                                class="table table-sm table-hover table-striped mb-0"
                                                style="font-size: 0.85rem;">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Kode Obat</th>
                                                        <th>Nama Obat</th>
                                                        <th>Stok</th>
                                                        <th class="text-right">Harga</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody-hasil-pencarian">
                                                    <!-- Data dari AJAX dimasukkan ke sini -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- FORM DINAMIS (Tabel Obat Terpilih) -->
                                <form action="" method="POST" id="form-resep" class="form-resep">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-primary text-white py-2">
                                            <h6 class="mb-0 font-weight-bold" style="font-size: 0.9rem;">
                                                <i class="fas fa-capsules mr-1"></i> Daftar Obat Terpilih
                                            </h6>
                                        </div>
                                        <div class="card-body p-3">
                                            <div class="table-responsive">
                                                <table class="table table-bordered align-middle w-100"
                                                    id="table-obat-terpilih" style="font-size: 0.85rem;">
                                                    <thead class="thead-dark text-center">
                                                        <tr>
                                                            <th style="width: 15%;">Kode</th>
                                                            <th style="width: 30%;">Nama Obat</th>
                                                            <th style="width: 15%;">Signa 1</th>
                                                            <th style="width: 15%;">X</th>
                                                            <th style="width: 12%;">Signa 2</th>
                                                            <th style="width: 12%;">Jumlah</th>
                                                            <th style="width: 10%;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody-obat-terpilih">
                                                        <tr id="empty-row">
                                                            <td colspan="6" class="text-center text-muted py-3">Belum
                                                                ada obat yang dipilih.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- <div class="d-flex justify-content-end mt-3">
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm px-4 font-weight-bold">
                                                    <i class="fas fa-save mr-1"></i> Simpan Resep
                                                </button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form_jenis_obat">

                                        </div>
                                    </div>
                                </div> --}}
                                <button class="btn btn-danger float-right ml-1" onclick="location.reload()"><i
                                        class="bi bi-x-square"></i> batal</button>
                                <button class="btn btn-primary float-right" onclick="simpanrujukan_prb()"><i
                                        class="bi bi-sd-card"></i> simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="modalprogramprb" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pilihan program</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="tableprogramprb" class="table table-sm table-bordered text-center">
                            <thead>
                                <th>Kode</th>
                                <th>Nama Diagnosa</th>
                                <th>---</th>
                            </thead>
                            <tbody>
                                @foreach ($program_prb->response->list as $p)
                                    <tr>
                                        <td> {{ $p->kode }} </td>
                                        <td> {{ $p->nama }} </td>
                                        <td> <button class="badge badge-success pilihprogram" nama="{{ $p->nama }}"
                                                kode="{{ $p->kode }}" data-dismiss="modal">+</button> </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            // 1. EVENT KLIK CARI OBAT
            $('#btn-search-obat').on('click', function() {
                let keyword = $('#search-input').val();
                if (keyword.trim() === '') {
                    alert('Masukkan nama obat terlebih dahulu!');
                    return;
                }
                $.ajax({
                    url: "{{ route('cariobatprb') }}", // Ganti dengan route pencarian controller Anda
                    type: "GET",
                    data: {
                        q: keyword
                    },
                    beforeSend: function() {
                        $('#tbody-hasil-pencarian').html(
                            '<tr><td colspan="5" class="text-center py-2"><i class="fas fa-spinner fa-spin"></i> Memuat data...</td></tr>'
                        );
                        $('#container-hasil-pencarian').show();
                    },
                    success: function(response) {
                        let html = '';
                        if (response.length > 0) {
                            $.each(response, function(index, item) {
                                html += `
                            <tr>
                                <td>${item.kode_obat}</td>
                                <td>${item.nama_obat}</td>
                                <td>${item.stok}</td>
                                <td class="text-right">Rp ${parseInt(item.harga).toLocaleString('id-ID')}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-sm btn-pilih-obat" 
                                        data-id="${item.id}"
                                        data-kode="${item.kode_obat}"
                                        data-nama="${item.nama_obat}"
                                        data-harga="${item.harga}">
                                        <i class="fas fa-plus mr-1"></i> Pilih
                                    </button>
                                </td>
                            </tr>
                        `;
                            });
                        } else {
                            html =
                                '<tr><td colspan="5" class="text-center text-muted py-2">Obat tidak ditemukan.</td></tr>';
                        }
                        $('#tbody-hasil-pencarian').html(html);
                    }
                });
            });

            // Cari via pencetan ENTER pada input
            $('#search-input').on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    $('#btn-search-obat').click();
                }
            });

            // 2. EVENT PILIH OBAT (TAMBAH KE FORM DINAMIS)
            $(document).on('click', '.btn-pilih-obat', function() {
                let id = $(this).data('id');
                let kode = $(this).data('kode');
                let nama = $(this).data('nama');
                let harga = parseFloat($(this).data('harga'));

                // Cek jika obat sudah ada di form dinamis
                if ($(`#row-obat-${id}`).length > 0) {
                    let qtyInput = $(`#qty-${id}`);
                    qtyInput.val(parseInt(qtyInput.val()) + 1).trigger('input');
                    return;
                }

                // Hapus baris kosong jika ada
                $('#empty-row').remove();

                // Append elemen baris baru
                let newRow = `
            <tr id="row-obat-${id}">
                <td class="align-middle text-center">
                    <input type="hidden" name="kdObat" value="${id}" id="oabt_id">
                    <span class="font-weight-bold">${kode}</span>
                </td>
                <td class="align-middle">${nama}</td>
                <td class="align-middle text-right">
                    <input type="text" name="signa1" class="form-control form-control-sm text-center input-qty" id="signa1" value="1" min="1">
                </td>
                <td class="align-middle text-center">
                    x
                </td>
                <td class="align-middle">
                    <input type="text" name="signa2" class="form-control form-control-sm text-center input-qty" id="signa2" value="1" min="1">
                </td>
                <td class="align-middle text-right font-weight-bold">
                    <input type="text" name="jmlObat" class="form-control form-control-sm text-center input-qty" id="qty" value="1" min="1">
                </td>
                <td class="align-middle text-center">
                    <button type="button" class="btn btn-danger btn-sm btn-hapus-row"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
                $('#tbody-obat-terpilih').append(newRow);
            });

            // 4. HAPUS ROW FORM DINAMIS
            $(document).on('click', '.btn-hapus-row', function() {
                $(this).closest('tr').remove();
                if ($('#tbody-obat-terpilih tr').length === 0) {
                    $('#tbody-obat-terpilih').html(`
                <tr id="empty-row">
                    <td colspan="6" class="text-center text-muted py-3">Belum ada obat yang dipilih.</td>
                </tr>
            `);
                }
            });

        });
    </script>
    <script>
        $(function() {
            $("#tableprogramprb").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [1, "desc"]
                ]
            })
        });
        $('#tableprogramprb').on('click', '.pilihprogram', function() {
            nama = $(this).attr('nama')
            kode = $(this).attr('kode')
            $('#programprb').val(nama + ' ( ' + kode + ' ) ')
            $('#kodeprogramprb').val(kode)
        });
        $(document).ready(function() {
            $('#dokter_prb').autocomplete({
                source: "<?= route('caridokter') ?>",
                select: function(event, ui) {
                    $('[id="dokter_prb"]').val(ui.item.label);
                    $('[id="kodedokter_prb"]').val(ui.item.kode);
                }
            });
        });

        function add_jenisobat() {
            jlhjns_obat = $('#jlhjns_obat').val()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    jlhjns_obat
                },
                url: '<?= route('vclaimambil_formjenisobat') ?>',
                error: function(data) {
                    alert('error!')
                },
                success: function(response) {
                    $('.form_jenis_obat').html(response);
                }
            });
        }

        function simpanrujukan_prb() {
            sep_prb = $('#sep_prb').val()
            noka_prb = $('#noka_prb').val()
            email_prb = $('#email_prb').val()
            kodeprogramprb = $('#kodeprogramprb').val()
            kodedokter_prb = $('#kodedokter_prb').val()
            alamatpx_prb = $('#alamatpx_prb').val()
            keterangan_prb = $('#keterangan_prb').val()
            saran_prb = $('#saran_prb').val()
            var dataobat = $('.form-resep').serializeArray();
            //1
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                async: true,
                dataType: 'Json',
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    sep_prb,
                    noka_prb,
                    email_prb,
                    kodeprogramprb,
                    kodedokter_prb,
                    alamatpx_prb,
                    keterangan_prb,
                    saran_prb,
                    dataobat: JSON.stringify(dataobat),

                },
                url: '<?= route('vclaimsimpan_prb') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Rujukan khusus Berhasil dibuat !',
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: data.message,
                        })
                    }
                }
            });
        }
        $(function() {
            $("#tabelpencarian").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [0, "desc"]
                ]
            })
        });
    </script>
@endsection
