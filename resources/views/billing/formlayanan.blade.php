<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-outline card-success" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                Nomor RM
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['nomorm'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Nama
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['nama'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Jenis Kelamin
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['jk'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Alamat
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['alamat'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Unit
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['unit'] }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                Penjamin
                            </div>
                            <div class="col-md-9">
                                :  {{ $pasien['penjamin'] }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-success">Input Layanan</div>
                <div class="card-body">
                    <table id="table-tarif" class="table table-sm">
                        <thead>
                            <th>Nama Layanan</th>
                            <th>VVIP</th>
                            <th>VIP</th>
                            <th>I</th>
                            <th>II</th>
                            <th>III</th>
                        </thead>
                        <tbody>
                            @foreach ($tarif as $t)
                                <tr>
                                    <td>{{ $t->NAMA_LAYANAN}}</td>
                                    <td>{{ $t->VVIP}}</td>
                                    <td>{{ $t->VIP}}</td>
                                    <td>{{ $t->I}}</td>
                                    <td>{{ $t->II}}</td>
                                    <td>{{ $t->III}}</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#table-tarif").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 3,
            "order": [
                [1, "desc"]
            ]
        })
    });
</script>