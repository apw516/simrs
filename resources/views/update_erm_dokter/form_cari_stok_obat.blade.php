<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0"><i class="fas fa-search mr-2"></i>Pencarian Obat Unit</h5>
    </div>
    <div class="card-body">
        <form id="formCariObat" onsubmit="cariObat(event)">
            <div class="form-row">
                <div class="form-group col-md-7 mb-md-0">
                    <label for="keyword" class="font-weight-bold">Nama / Kode Obat</label>
                    <input type="text" class="form-control" id="keyword"
                        placeholder="Masukkan nama atau kode obat..." required>
                </div>
                <div class="form-group col-md-3 mb-md-0">
                    <label for="unit" class="font-weight-bold">Unit Pelayanan</label>
                    <select class="custom-select" id="unit" required>
                        <option value="" selected disabled>-- Pilih Unit --</option>
                        <option value="4008" @if ($penjamin != 'P01') selected @endif>Apotek Rawat Jalan
                        </option>
                        <option value="4001" @if ($penjamin == 'P01') selected @endif>Apotek Rawat Inap
                        </option>
                    </select>
                </div>
                <div class="form-group col-md-2 mb-0 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search mr-1"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card shadow-sm" id="cardHasil" style="display: none;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 font-weight-bold text-secondary">Hasil Pencarian</h6>
        <span class="badge badge-info p-2" id="badgeUnit">Unit: -</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="tabelstokobat" class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 50px;">No</th>
                        <th scope="col">Kode Obat</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Kategori</th>
                        <th scope="col" class="text-right">Stok Unit</th>
                        <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tabelBodyObat">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    // Gunakan window property / var agar aman dari redeclaration error
    var tableStok = tableStok || null;
    // window.tableStok = window.tableStok || null;
    $(function() {
        // Inisialisasi awal DataTables
        if (!$.fn.DataTable.isDataTable('#tabelstokobat')) {
            window.tableStok = $("#tabelstokobat").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [0, "asc"]
                ]
            });
        }
    });

    // Hindari 'async function cariObat' global biasa agar tidak error saat dipanggil ulang
    window.cariObat = async function(event) {
        event.preventDefault();

        const keyword = document.getElementById('keyword').value;
        const unit = document.getElementById('unit').value;
        const tabelBody = document.getElementById('tabelBodyObat');
        const cardHasil = document.getElementById('cardHasil');
        const badgeUnit = document.getElementById('badgeUnit');

        cardHasil.style.display = 'block';
        badgeUnit.textContent = `Unit: ${unit}`;

        // 1. Destroy DataTables lama sebelum manipulasi DOM
        if ($.fn.DataTable.isDataTable('#tabelstokobat')) {
            $('#tabelstokobat').DataTable().destroy();
        }

        // 2. State Loading
        tabelBody.innerHTML = `
        <tr>
            <td colspan="6" class="text-center py-4 text-muted">
                <div class="spinner-border spinner-border-sm mr-2 text-primary" role="status"></div>
                Memproses query pencarian data obat untuk unit <strong>${unit}</strong>...
            </td>
        </tr>
    `;

        try {
            const url = new URL('/simrs/cariobat', window.location.origin);
            url.searchParams.append('keyword', keyword);
            url.searchParams.append('unit', unit);

            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP Error status: ${response.status}`);
            }

            const resData = await response.json();
            const dataObat = resData.data || [];

            // 3. Validasi Data Kosong
            if (dataObat.length === 0) {
                tabelBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center py-4 text-danger">
                        Data obat dengan kata kunci "<strong>${keyword}</strong>" tidak ditemukan di unit <strong>${unit}</strong>.
                    </td>
                </tr>`;
                return;
            }

            // 4. Render HTML
            let htmlRows = '';
            dataObat.forEach((item, index) => {
                htmlRows += `
                <tr>
                    <td class="align-middle">${index + 1}</td>
                    <td class="align-middle"><span class="badge badge-secondary">${item.kode_barang}</span></td>
                    <td class="align-middle font-weight-bold">${item.nama_barang}</td>
                    <td class="align-middle">${item.sediaan || '-'}</td>
                    <td class="align-middle text-right font-weight-bold ${item.stok < 10 ? 'text-danger' : 'text-success'}">
                        ${item.stok} ${item.satuan_besar || ''}
                    </td>
                    <td class="align-middle text-center">
                        <button type="button" class="btn btn-sm btn-outline-primary pilihobat"
                                data-kode="${item.kode_barang}" 
                                data-nama="${item.nama_barang}">
                            <i class="bi bi-arrow-right-square"></i>
                        </button>
                    </td>
                </tr>
            `;
            });
            tabelBody.innerHTML = htmlRows;

            // 5. Inisialisasi ulang DataTables
            window.tableStok = $("#tabelstokobat").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 3,
                "searching": true,
                "order": [
                    [0, "asc"]
                ]
            });

        } catch (error) {
            console.error("Error fetching data:", error);
            tabelBody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-4 text-danger">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Gagal mengambil data dari server. Silakan coba lagi.
                </td>
            </tr>`;
        }
    };
    // 1. Pindahkan event handler hapus ke luar fungsi agar tidak terduplikasi
    // Event listener hapus baris obat
    $(document).off("click", ".remove_field").on("click", ".remove_field", function(e) {
        e.preventDefault();
        $(this).closest('.form-row').remove();
    });

    // Event listener pilih obat (Ditolak duplikatnya dengan .off())
    $(document).off("click", ".pilihobat").on("click", ".pilihobat", function(e) {
        e.preventDefault();

        const row = $(this).closest('tr');
        const kodeBarang = $(this).data('kode') || row.find('td:eq(1)').text().trim();
        const namaBarang = $(this).data('nama') || row.find('td:eq(2)').text().trim();

        addFormObat(kodeBarang, namaBarang);
    });
    // 3. Fungsi utama penambahan form input obat
    function addFormObat(kodeObat = '', namaObat = '') {
        const max_fields = 10;
        const wrapper = $(".formobatfarmasi2");
        // Hitung jumlah baris form yang ada saat ini
        const currentFields = wrapper.children('.form-row').length;
        if (currentFields >= max_fields) {
            alert('Maksimal penambahan 10 obat!');
            return;
        }
        // Update counter jumlah form
        let counter = parseInt($('#jumlahform').val()) || 0;
        counter++;
        $('#jumlahform').val(counter);
        const namaId = 'namaobat' + counter;
        const aturanId = 'aturanpakai' + counter;
        // Template HTML Form Input (Format name="...[]" agar terbaca array di server)
        const formHtml =
            `<div class="form-row text-xs">
                <div class="form-group col-md-2">
                    <label for="">Nama Obat</label>
                    <input type="" class="form-control form-control-sm text-xs" id="${namaId}" name="namaobat"
                        value="${namaObat}">
                    <input hidden readonly type="" class="form-control form-control-sm" id="" name="kodebarang"
                        value="${kodeObat}">
                </div>
                <div hidden class="form-group col-md-2">
                    <label for="inputPassword4">Aturan Pakai</label>
                    <input type="" class="form-control form-control-sm" id="' + aturan +'" name="aturanpakai" value="">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Jenis Resep</label>
                    <select class="form-control form-control-sm" id="jenisresep" name="jenisresep">
                        <option value="NON-RACIKAN">NON RACIKAN</option>
                        <option value="RACIKAN">RACIKAN</option>
                    </select>
                </div>
                <div class="form-group col-md-1">
                    <label for="inputPassword4">Jumlah Obat</label>
                    <input type="" class="form-control form-control-sm" id="" name="jumlah" value="0">
                </div>
                <div class="form-group col-md-1">
                    <label for="inputPassword4">Signa 1</label>
                    <input type="" class="form-control form-control-sm" id="" name="signa1" value="0">
                    <input hidden type="" class="form-control form-control-sm" id="" name="kode_kunjungan" value="0">
                </div>
                <div class="form-group col-md-1">
                    <label for="inputPassword4">Signa 2</label>
                    <input type="" class="form-control form-control-sm" id="" name="signa2" value="0">
                </div>
                <div class="form-group col-md-2">
                    <label for="inputPassword4">Keterangan</label>
                    <input type="" class="form-control form-control-sm" id="" name="keterangan" value="">
                </div>
                <i class="bi bi-x-square remove_field form-group col-md-2 text-danger"></i>
            </div>`;
        wrapper.append(formHtml);
        $(wrapper).on("click", ".remove_field", function(e) { //user click on remove
            kode = $(this).attr('kode2')
            e.preventDefault();
            $(this).parent('div').remove();
        })
    }
</script>
