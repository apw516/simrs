<table class="table table-sm table-bordered mt-4" id="tabelkunjungan">
    <thead>
        <th>Tgl Masuk</th>
        <th>No RM</th>
        <th>Nama</th>
        <th>Unit</th>
        <th>Penjamin</th>
        <th>Dokter</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($DATA as $D)
            <tr>
                <td>{{ $D->tgl_masuk }}</td>
                <td>{{ $D->no_rm }}</td>
                <td>{{ $D->nama_pasien }}</td>
                <td>{{ $D->nama_unit }}</td>
                <td>{{ $D->nama_penjamin }}</td>
                <td>{{ $D->nama_dokter }}</td>
                <td>
                    <button class="btn btn-info lihatberkas" kodekunjungan="{{ $D->kode_kunjungan }}">Lihat</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(function() {
        $("#tabelkunjungan").DataTable({
            "responsive": false,
            "lengthChange": false,
            // "autoWidth": true,
            "pageLength": 10,
            "searching": true,
            "order": [
                [1, "desc"]
            ]
        })
    });
    $(".lihatberkas").on('click', function(event) {
        kodekunjungan = $(this).attr('kodekunjungan')
        window.open('cetakresumerajalbykunjungan/' + kodekunjungan);
    });
</script>
