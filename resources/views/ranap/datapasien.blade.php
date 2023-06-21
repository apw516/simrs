@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pasien</h1>
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
        <div class="viewutama">
            <table id="tabelpasien" class="table table-sm table-bordered text-xs table-hover">
                <thead>
                    <th>Nomor BPJS</th>
                    <th>Nomor RM</th>
                    <th>Nama Pasien</th>
                    <th>Penjamin</th>
                </thead>
                <tbody>
                    @foreach ($datapasien as $d)
                        <tr class="klikdetail" nomorrom="{{ $d->no_rm }}">
                            <td>{{ $d->no_Bpjs }}</td>
                            <td>{{ $d->no_rm }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->nama_penjamin }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script>
        $(function() {
            $("#tabelpasien").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "pageLength": 8,
                "searching": true,
                "order": [
                    [3, "desc"]
                ]
            })
        });
        $('#tabelpasien').on('click', '.klikdetail', function() {
            spinner = $('#loader')
            spinner.show()
            rm = $(this).attr('nomorrom')
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    rm
                },
                url: '<?= route('lihatcatatanpasien') ?>',
                error: function(data) {
                    spinner.hide()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops,silahkan coba lagi',
                    })
                },
                success: function(response) {
                    spinner.hide()
                    $('.viewutama').html(response)
                }
            });
        });
    </script>
@endsection
