@extends('dashboard.layouts.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Data User</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <button class="btn btn-success" data-toggle="modal" data-target="#modalkodeparamedis">lihat kode
                    paramedis</button>
                <div class="vpasien">

                </div>
        </section>
        <!-- Modal -->
        <div class="modal fade" id="modalkodeparamedis" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lihat Kode Paramedis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table id="tableparamedis" class="table table-sm table-bordered">
                            <thead>
                                <th>Kode Paramedis</th>
                                <th>Nama</th>
                                <th>Unit</th>
                            </thead>
                            <tbody>
                                @foreach ($paramedis as $p)
                                    <tr>
                                        <td>{{ $p->kode_paramedis }}</td>
                                        <td>{{ $p->nama_paramedis }}</td>
                                        <td>{{ $p->nama_unit }}</td>
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

        <script>
            $(document).ready(function() {
                ambildatauser()
            });

            function ambildatauser() {
                spinner = $('#loader')
                spinner.show();
                $.ajax({
                    type: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    url: '<?= route('ambiltabeldatauser') ?>',
                    success: function(response) {
                        spinner.hide()
                        $('.vpasien').html(response);
                    }
                });
            }
            $(function() {
                $("#tableparamedis").DataTable({
                    "responsive": false,
                    "lengthChange": false,
                    "autoWidth": true,
                    "pageLength": 10,
                    "searching": true,
                    "order": ['0', "desc"]
                })
            });
        </script>
    @endsection
