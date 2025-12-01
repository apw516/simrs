<div class="card mt-4">
    <div class="card-header">Data Kunjungan Dengan Nomor SEP</div>
    <div class="card-body">
    </div>
    <table class="table table-sm text-sm table-bordered table-hover" id="tabelkunjungan">
        <thead>
            <th>Tanggal Masuk</th>
            <th>Nomor SEP</th>
            <th>Nomor RM</th>
            <th>Nama Pasien</th>
            <th>Nama Dokter</th>
            <th>Unit</th>
            <th>Status Kunjungan</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($data as $d)
                @if (strlen($d->no_sep) > 18)
                    <tr>
                        <td>{{ $d->tgl_masuk }}</td>
                        <td>{{ $d->no_sep }}</td>
                        <td>{{ $d->no_rm }}</td>
                        <td>{{ $d->nama_pasien }}</td>
                        <td>{{ $d->nama_dokter }}</td>
                        <td>{{ $d->nama_unit }}</td>
                        <td>{{ $d->status_kunjungan }}</td>
                        <td>
                            <button class="btn btn-sm btn-success downloadberkas"
                                kode_kunjungan="{{ $d->kode_kunjungan }}">Download berkas</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<div class="card mt-2">
    <div class="card-header">Data Kunjungan Tanpa Nomor SEP</div>
    <div class="card-body">
    </div>
    <table class="table table-sm text-sm table-bordered table-hover" id="tabelkunjungan2">
        <thead>
            <th>Tanggal Masuk</th>
            <th>Nomor SEP</th>
            <th>Nomor RM</th>
            <th>Nama Pasien</th>
            <th>Nama Dokter</th>
            <th>Unit</th>
            <th>Status Kunjungan</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($data as $d)
                @if (strlen($d->no_sep) < 18)
                    <tr>
                        <td>{{ $d->tgl_masuk }}</td>
                        <td>{{ $d->no_sep }}</td>
                        <td>{{ $d->no_rm }}</td>
                        <td>{{ $d->nama_pasien }}</td>
                        <td>{{ $d->nama_dokter }}</td>
                        <td>{{ $d->nama_unit }}</td>
                        <td>{{ $d->status_kunjungan }}</td>
                        <td>
                            <button class="btn btn-sm btn-success downloadberkas"
                                kode_kunjungan="{{ $d->kode_kunjungan }}">Download berkas</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function() {
        $("#tabelkunjungan2").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "order": false
        })
    });
    $(function() {
        $("#tabelkunjungan").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": true,
            "pageLength": 8,
            "searching": true,
            "order": false
        })
    });
    $('.downloadberkas').on('click', function() {
        kode_kunjungan = $(this).attr('kode_kunjungan')
        window.open('downloadberkas/' + kode_kunjungan)
    })
</script>
