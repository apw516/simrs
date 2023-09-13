<div class="row mt-2">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/img/logouser.png') }}"
                        alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $mt_pasien[0]->nama_px }}</h3>

                <p class="text-muted text-center">{{ $mt_pasien[0]->alamat }}</p>

                <ul class="list-group list-group-unbordered mb-">
                    <li class="list-group-item">
                        <b>RM </b> <a class="float-right text-dark">{{ $mt_pasien[0]->no_rm }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tgl Lahir</b> <a class="float-right text-dark">{{ $mt_pasien[0]->tgl_lahir }} | usia
                            {{ $mt_pasien[0]->umur }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Pengirim</b> <a class="float-right text-dark">{{ $header_layanan[0]->unit_pengirim }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Dokter</b> <a class="float-right text-dark">{{ $header_layanan[0]->dok_kirim }}</a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-info">Detail Resep</div>
            <div class="card-body">
                <table id="tabel_detail_resep" class="table table-sm text-xs table-hover">
                    <thead>
                        <th>Keterangan</th>
                        <th>Tgl entry</th>
                        <th>Kode Layanan Header</th>
                        <th>Kode Layanan Detail</th>
                        <th>Status Layanan</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Satuan</th>
                        <th>Total Layanan</th>
                        <th>---</th>
                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            <tr>
                                <td>{{ $d->keterangan }}</td>
                                <td>{{ $d->tgl_entry }}</td>
                                <td>{{ $d->kode_layanan_header }}</td>
                                <td>{{ $d->id_layanan_detail }}</td>
                                <td>{{ $d->status_layanan }}</td>
                                <td>{{ $d->namabarang }}</td>
                                <td>{{ $d->jumlah_layanan }}</td>
                                <td>{{ $d->satuan_barang }}</td>
                                <td>
                                    IDR {{ number_format($d->total_layanan, 2) }}
                                </td>
                                <td><button idheader="{{ $d->id_header }}" iddetail="{{ $d->id_detail }}"
                                        class="btn btn-danger btn-sm tombolretur" data-toggle="modal"
                                        data-target="#modalretur"><i class="bi bi-recycle"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalretur" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Retur Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-retur">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal Retur</button>
                <button type="button" class="btn btn-primary" onclick="simpanretur()">Retur</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        $("#tabel_detail_resep").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 6,
            "searching": true,
            "ordering": false,
        })
    });
    $(".tombolretur").on('click', function(event) {
        idheader = $(this).attr('idheader')
        iddetail = $(this).attr('iddetail')
        $.ajax({
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                idheader,
                iddetail
            },
            url: '<?= route('ambil_data_obat_retur') ?>',
            success: function(response) {
                $('.form-retur').html(response);
                spinner.hide()
            }
        });
    });

    function simpanretur() {
        obat = $('#namabarang').val()
        jumlahretur = $('#jumlahretur').val()
        Swal.fire({
            title: 'Retur Obat '+ obat + ' ? ',
            text: "Klik batal untuk batal retur !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Batal',
            confirmButtonText: 'Ya Retur obat !'
        }).then((result) => {
            if (result.isConfirmed) {
                spinner = $('#loader')
                spinner.show();
                var data = $('.form_isian_retur').serializeArray();
                $.ajax({
                    async: true,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        data: JSON.stringify(data),
                    },
                    url: '<?= route('simpanretur') ?>',
                    error: function(data) {
                        spinner.hide()
                        Swal.fire({
                            icon: 'error',
                            title: 'Ooops....',
                            text: 'Sepertinya ada masalah......',
                            footer: ''
                        })
                    },
                    success: function(data) {
                        spinner.hide()
                        if (data.kode == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oopss...',
                                text: data.message,
                                footer: ''
                            })
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: data.message,
                                footer: ''
                            })
                        }
                    }
                });
            }
        })
    }
</script>
