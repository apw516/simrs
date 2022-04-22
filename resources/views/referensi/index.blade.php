@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <div class="input-group mb-3 mt-3">
                        <input disabled type="text" class="form-control" id="pencariansep"
                            placeholder="Masih dalam tahap pengembangan ...">
                        <div class="input-group-append">
                            <button disabled class="btn btn-outline-primary" type="button" id="button-addon2" onclick="carisuratkontrol()"
                            data-toggle="modal"
                            data-target="#modaleditsuratkontrol"><i class="bi bi-search-heart"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">REFERENSI VCLAIM </h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pendaftaran')}}">Pendaftaran</a></li>
                        <li class="breadcrumb-item active">Referensi</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="card collapsed-card">
            <div class="card-header bg-success">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                    </button>
                </div>
                <h4>Data Dokter</h4>
            </div>
            <div class="card-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-sm-3">
                           <select class="form-control" id="filter_rs">
                                <option value="1">Rawat Inap</option>
                                <option value="2" selected>Rawat Jalan</option>
                            </select>
                        </div> 
                        <div class="col-sm-3">
                           <select class="form-control" id="poli">
                               @foreach ($poli as $p )
                               @if($p->kelas_unit == 1)
                               <option value="{{ $p->KDPOLI}}">{{ $p->nama_unit}}</option>                                   
                               @endif
                               @endforeach
                            </select>
                        </div> 
                        <div class="col-sm-2">
                            <input type="text" class="form-control datepicker" id="tanggal"
                                data-date-format="yyyy-mm-dd" placeholder="Masukan No kartu ..">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-dark mb-2" onclick="caridokter()">Cari</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="listdokter">
                        <table id="tabeldokter" class="table table-bordered table-sm text-xs mt-3">
                            <thead>
                                <th>Kode</th>
                                <th>Nama</th>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
        function caridokter()
        {            
            tanggal = $('#tanggal').val()
            poli = $('#poli').val()
            filter = $('#filter_rs').val()
            spinner = $('#loader');
            spinner.show();
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    tanggal,
                    poli,
                    filter
                },
                url: '<?= route('vclaimreferensidokter') ?>',
                error: function(data) {
                    spinner.hide();
                    alert('error!')
                },
                success: function(response) {
                    spinner.hide();
                    $('.listdokter').html(response);
                    // $('#daftarpxumum').attr('disabled', true);
                }
            });
        }
        $(function() {
            $("#tabeldokter").DataTable({
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
        $(function() {
            $("#tabelsuratkontrol_peserta").DataTable({
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
        $('#tabelsuratkontrol_rs').on('click', '.hapussurat', function() {
            nomorsurat = $(this).attr('nomorsurat')
            Swal.fire({
                title: 'surat kontrol ' + nomorsurat,
                text: "Surat kontrol akan dihapus ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    spinner = $('#loader')
                    spinner.show()
                    $.ajax({
                        type: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            nomorsurat,
                        },
                        dataType: 'Json',
                        Async: true,
                        url: '<?= route('vclaimhapussurkon') ?>',
                        error: function(data) {
                            spinner.hide()
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops,silahkan coba lagi',
                            })
                        },
                        success: function(data) {
                            spinner.hide()
                            if (data.metaData.code == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil dihapus ...',
                                })
                                location.reload()
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: data.metaData.message,
                                })
                            }
                        }
                    });
                }
            });
        });
        $('#tabelsuratkontrol_rs').on('click', '.editsurat', function() {
            tgl = $(this).attr('tglkontrol')
            jenissurat = $(this).attr('jenissurat')
            suratkontrol = $(this).attr('suratkontrol')
            nomorsep = $(this).attr('nomorsep')
            nomorkartu = $(this).attr('nomorkartu')
            namapolitujuan = $(this).attr('namapolitujuan')
            kodepolitujuan = $(this).attr('kodepolitujuan')
            namadokter = $(this).attr('namadokter')
            kodedokter = $(this).attr('kodedokter')
            if (jenissurat == 1) {
                nomor = nomorkartu
            } else {
                nomor = nomorsep
            }
            $('#editjenissurat').val(jenissurat)
            $('#edittanggalkontrol').val(tgl)
            $('#editnomorkartukontrol').val(nomor)
            $('#editpolikontrol').val(namapolitujuan)
            $('#editkodepolikontrol').val(kodepolitujuan)
            $('#editdokterkontrol').val(namadokter)
            $('#editkodedokterkontrol').val(kodedokter)
            $('#editnomorsurat').val(suratkontrol)
        });
    </script>
@endsection
