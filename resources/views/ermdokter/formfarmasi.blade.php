<div class="card">
    <div class="card-header bg-success">Pilih Order Farmasi</div>
    <div class="card-body">
        <div class="container-fluid">
            @if (count($resume) > 0)
                <div class="row">
                    <div class="col-md-12" style="margin-top:20px">
                        <h5>Silahkan Cari Obat</h5>
                        <input type="text" class="form-control pencarianobat" id="pencarianobat"
                            placeholder="Cari nama obat">
                        <div class="tableobat">

                        </div>
                        {{-- <table id="tabeltindakan" class="table table-hover table-sm">
                            <thead>
                                <th>Nama tindakan</th>
                            </thead>
                            <tbody>
                                @foreach ($layanan as $t)
                                    <tr class="pilihlayanan" namatindakan="{{ $t->Tindakan }}"
                                        tarif="{{ $t->tarif }}" kode="{{ $t->kode }}">
                                        <td>{{ $t->Tindakan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                    </div>
                    <div class="col-md-12" style="margin-top:20px">
                        <div class="card">
                            <div class="card-header bg-success">Order Obat</div>
                            <div class="card-body">
                                <form action="" method="post" class="formtindakan">
                                    <div class="input_fields_wrap">
                                        <div>
                                        </div>
                                        <button type="button" class="btn btn-warning mb-2 simpanlayanan"
                                            id="simpanlayanan">Simpan Tindakan</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p>pilih layanan untuk pasien</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-header bg-warning" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left text-dark btn-sm" type="button"
                                            data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Riwayat Order Obat Hari Ini
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="tindakanhariini">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Assesmen awal medis belum diisi
                        ...</h3>
                    <p>
                        Anda harus mengisi assesmen awal medis terlebih dulu ... </a>
                    </p>
                </div>
            @endif
        </div>
    </div>
    <script>
        $('#pencarianobat').on('input', function() {
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    key: $('#pencarianobat').val(),
                    kodekunjungan
                },
                url: '<?= route('cariobat') ?>',
                success: function(response) {
                    $('.tableobat').html(response);
                    spinner.hide()
                }
            });
        });
        $(function() {
            $("#tabeltindakan").DataTable({
                "responsive": false,
                "lengthChange": false,
                "pageLength": 10,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });

        $(".simpanlayanan").click(function() {
            var data = $('.formtindakan').serializeArray();
            var kodekunjungan = $('#kodekunjungan').val()
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                async: true,
                type: 'post',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: JSON.stringify(data),
                    kodekunjungan: kodekunjungan,
                },
                url: '<?= route('simpanorderfarmasi') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Sepertinya ada masalah ...',
                        footer: ''
                    })
                },
                success: function(data) {
                    spinner.hide()
                    if (data.kode == 500) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message,
                            footer: ''
                        })
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'OK',
                            text: 'Data berhasil disimpan!',
                            footer: ''
                        })
                        orderobathariini()
                    }
                }
            });
        });
        $(document).ready(function() {
            orderobathariini()
        });

        function orderobathariini() {
            spinner = $('#loader')
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    kodekunjungan: $('#kodekunjungan').val()
                },
                url: '<?= route('orderobathariini') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    $('.tindakanhariini').html(response)
                    spinner.hide()
                }
            });
        }
    </script>
